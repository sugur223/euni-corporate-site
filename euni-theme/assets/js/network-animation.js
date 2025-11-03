/**
 * Network Topology Animation
 * ネットワークトポロジーアニメーション - 中心から徐々に広がるつながり
 */

(function() {
    'use strict';

    const canvas = document.getElementById('networkCanvas');
    if (!canvas) return;

    const ctx = canvas.getContext('2d');
    let width, height, centerX, centerY;
    let nodes = [];
    let animationId;
    let progress = 0; // アニメーション進行度 (0-1)
    let mouse = { x: null, y: null };
    let nodeSpawnTimer = 0;
    let distanceBounds = { min: 0, max: 0, widthLimit: 0, heightLimit: 0 };
    let lastNodeAddedAt = Date.now();

    // 設定
    const config = {
        maxNodes: 18,           // 最大ノード数
        initialNodes: 5,        // 初期ノード数
        nodeSpawnInterval: 200, // ノード追加間隔（ms）
        nodeRadius: 8,          // ノードの基本半径
        minNodeRadius: 4,       // 最小半径（奥）
        maxNodeRadius: 12,      // 最大半径（手前）
        expandDuration: 3000,   // 広がるアニメーションの時間（ms）
        fadeInDuration: 2000,   // フェードインの時間（ms）
        floatSpeed: 0.00014,    // 浮遊速度
        lineOpacity: 0.25,      // 線の透明度
        minLineOpacity: 0.08,   // 最小線透明度（奥）
        maxLineOpacity: 0.35,   // 最大線透明度（手前）
        minLineWidth: 1,        // 最小線太さ（奥）
        maxLineWidth: 3,        // 最大線太さ（手前）
        nodeColor: '#666666',   // ノードの色
        lineColor: '#999999',   // 線の色
        mouseRadius: 280,       // マウスの影響範囲（さらに広く）
        mouseForce: 0.7,        // マウスの引力（かなり強く）
        avoidCenter: false,     // レスポンシブで更新
        maxDistance: 240,       // 線を引く最大距離（レスポンシブで更新）
        minDistanceFactor: 0.16, // ノード生成距離の最小係数
        maxDistanceFactor: 0.58,// ノード生成距離の最大係数
        edgePadding: 16,        // キャンバス端の余白（変動可能）
        topPadding: 80,         // 上方向の余白（PC時にヘッダーまで届かないように）
        driftAmplitude: 0.25,   // ノードの揺らぎ幅（ラジアン）
        separationDistance: 120,// ノード間の理想距離
        separationStrength: 0.18,// ノード間の離反強度
        moveSmoothing: 0.06,    // 目標へ向かうスムーズさ
        settleDelay: 1200       // 追加が終わってから動き始めるまでの待機時間
    };

    function applyResponsiveSettings() {
        const isMobile = window.innerWidth <= 768;
        const effectiveWidth = width || canvas.parentElement.clientWidth;
        const effectiveHeight = height || canvas.parentElement.clientHeight;
        const minDimension = Math.min(effectiveWidth, effectiveHeight);

        config.lineOpacity = isMobile ? 0.18 : 0.25;
        config.nodeColor = isMobile ? '#b5b5b5' : '#666666';
        config.lineColor = isMobile ? '#d6d6d6' : '#999999';
        config.avoidCenter = false; // モバイルでも中央含め縦方向へ広げる
        config.minDistanceFactor = isMobile ? 0.08 : 0.16;
        config.maxDistanceFactor = isMobile ? 0.85 : 0.62;
        config.edgePadding = isMobile ? -40 : 16; // モバイルは余白なしでヒーロー外にも広げる
        config.topPadding = isMobile ? -40 : 80; // PCは上方向に余白を設ける（ヘッダーまで届かないように）
        config.driftAmplitude = isMobile ? 0.32 : 0.22;
        config.separationDistance = Math.min(minDimension * (isMobile ? 0.34 : 0.28), (effectiveWidth / 2) * 0.9);
        config.separationStrength = isMobile ? 0.1 : 0.16;
        config.moveSmoothing = isMobile ? 0.045 : 0.06;
        config.settleDelay = isMobile ? 1000 : 1500;
    }

    function updateDistanceBounds() {
        const minDimension = Math.min(width, height);
        const widthLimit = Math.max((width / 2) - config.edgePadding, minDimension * 0.25);
        const heightLimitTop = Math.max((height / 2) - config.topPadding, minDimension * 0.25); // 上方向の制限
        const heightLimitBottom = Math.max((height / 2) - config.edgePadding, minDimension * 0.3); // 下方向の制限
        const heightLimit = Math.min(heightLimitTop, heightLimitBottom); // より小さい方を採用
        let radialLimit = Math.min(minDimension * config.maxDistanceFactor, widthLimit);

        if (!isFinite(radialLimit) || radialLimit <= 0) {
            radialLimit = minDimension * 0.4;
        }

        let minDistance = Math.min(minDimension * config.minDistanceFactor, radialLimit * 0.7);
        if (minDistance >= radialLimit) {
            minDistance = radialLimit * 0.6;
        }

        distanceBounds = {
            min: Math.max(minDistance, radialLimit * 0.4),
            max: radialLimit,
            widthLimit,
            heightLimit,
            heightLimitTop,
            heightLimitBottom,
            aspect: Math.min(heightLimit / Math.max(widthLimit, 1), 1.6)
        };

        config.maxDistance = distanceBounds.max * 1.35;
        config.separationDistance = Math.min(config.separationDistance, distanceBounds.max * 0.75);
    }

    function shouldLockNodes() {
        const stillGrowing = nodes.length < config.maxNodes;
        const recentlyAdded = Date.now() - lastNodeAddedAt < config.settleDelay;
        return stillGrowing || recentlyAdded;
    }

    // ノードクラス
    class Node {
        constructor(angle, distance, index, spawnTime) {
            this.angle = angle;
            this.baseAngle = angle;
            this.maxDistance = distance; // 最終的な距離
            this.currentDistance = 0;    // 現在の距離（アニメーション用）
            this.index = index;
            this.spawnTime = spawnTime;  // 生成時刻
            this.opacity = 0;            // 透明度（フェードイン用）
            this.lineOpacity = 0;        // 線の透明度（ノードより遅れてフェードイン）
            this.driftPhase = Math.random() * Math.PI * 2;
            this.driftSpeed = (0.0002 + Math.random() * 0.00025) * (Math.random() < 0.5 ? -1 : 1);

            // 深度（0-1: 0=奥、1=手前）を追加
            this.baseDepth = 0.45 + Math.random() * 0.3; // 基本深度を中間付近に（0.45〜0.75）
            this.depth = this.baseDepth; // 現在の深度（動的に変化）

            // 奥行き方向の浮遊用パラメータ
            this.depthPhase = Math.random() * Math.PI * 2; // 深度変化の位相
            this.depthSpeed = (0.00025 + Math.random() * 0.00025) * (Math.random() < 0.5 ? -1 : 1); // ゆっくりとした速度に調整
            this.depthAmplitude = 0.35 + Math.random() * 0.2; // 深度変化幅を大きく（±0.35〜0.55）

            // 深度に応じたサイズを計算（updatePositionで更新）
            this.radius = config.minNodeRadius + (config.maxNodeRadius - config.minNodeRadius) * this.depth;

            // 浮遊用のパラメータ
            this.floatAngle = Math.random() * Math.PI * 2;
            this.floatSpeed = config.floatSpeed * (0.5 + Math.random() * 0.5);
            this.baseFloatRadius = 15 + Math.random() * 25; // 基本浮遊範囲
            this.floatRadius = this.baseFloatRadius * this.depth; // 深度に応じて浮遊範囲も調整

            // マウス追従用
            this.targetX = centerX;
            this.targetY = centerY;
            this.currentX = centerX;
            this.currentY = centerY;
            this.initialized = false;

            this.updatePosition();
        }

        updatePosition(allNodes, lockMovement) {
            // 個別の進行度（生成時刻を考慮）
            const timeSinceSpawn = Date.now() - this.spawnTime;
            const individualProgress = Math.min(timeSinceSpawn / config.expandDuration, 1);
            const easedProgress = this.easeOutCubic(individualProgress);

            this.currentDistance = this.maxDistance * easedProgress;

            // フェードイン効果（より長い時間をかけて徐々に濃く）
            const fadeProgress = Math.min(timeSinceSpawn / config.fadeInDuration, 1);
            this.opacity = this.easeOutCubic(fadeProgress);

            // 線のフェードイン（ノードが70%表示されてから開始）
            const lineStartDelay = config.fadeInDuration * 0.7; // ノードフェードインの70%後に開始
            const lineFadeDuration = config.fadeInDuration * 0.8; // 線のフェードイン時間
            const lineFadeProgress = Math.max(0, Math.min((timeSinceSpawn - lineStartDelay) / lineFadeDuration, 1));
            this.lineOpacity = this.easeOutCubic(lineFadeProgress);

            // ベース角度に揺らぎを追加
            const drift = lockMovement ? 0 : Math.sin(timeSinceSpawn * this.driftSpeed + this.driftPhase) * config.driftAmplitude;
            this.angle = this.baseAngle + drift;

            // 奥行き方向の浮遊（深度の動的変化）
            const depthDrift = lockMovement ? 0 : Math.sin(timeSinceSpawn * this.depthSpeed + this.depthPhase) * this.depthAmplitude;
            this.depth = Math.max(0.15, Math.min(1.0, this.baseDepth + depthDrift)); // 0.15〜1.0の範囲に制限（極端に薄くなりすぎないように）

            // 深度に応じてサイズと浮遊範囲を更新
            this.radius = config.minNodeRadius + (config.maxNodeRadius - config.minNodeRadius) * this.depth;
            this.floatRadius = this.baseFloatRadius * this.depth; // 深度に応じて浮遊範囲を動的に調整

            // 浮遊効果を追加
            const floatX = lockMovement ? 0 : Math.cos(this.floatAngle) * this.floatRadius * easedProgress;
            const floatY = lockMovement ? 0 : Math.sin(this.floatAngle) * this.floatRadius * easedProgress;

            const distanceX = Math.cos(this.angle) * this.currentDistance;
            const distanceY = Math.sin(this.angle) * this.currentDistance * distanceBounds.aspect;

            this.targetX = centerX + distanceX + floatX;
            this.targetY = centerY + distanceY + floatY;

            if (!this.initialized) {
                this.currentX = this.targetX;
                this.currentY = this.targetY;
                this.initialized = true;
            }

            if (lockMovement) {
                this.currentX = this.targetX;
                this.currentY = this.targetY;
                this.x = this.currentX;
                this.y = this.currentY;
                return;
            }

            // マウスの影響を適用（ぬるぬる追従）
            if (mouse.x !== null && mouse.y !== null) {
                const dx = mouse.x - this.targetX;
                const dy = mouse.y - this.targetY;
                const distance = Math.sqrt(dx * dx + dy * dy);

                if (distance < config.mouseRadius) {
                    // 距離に応じた力の計算（より滑らかな曲線）
                    const normalizedDist = distance / config.mouseRadius;
                    const force = Math.pow(1 - normalizedDist, 1.5) * config.mouseForce;
                    this.targetX += dx * force;
                    this.targetY += dy * force;
                }
            }

            // 他ノードとの距離を保つ（単純な離反）
            if (Array.isArray(allNodes)) {
                let separationX = 0;
                let separationY = 0;

                for (let i = 0; i < allNodes.length; i++) {
                    const other = allNodes[i];
                    if (other === this) continue;

                    const otherX = typeof other.targetX === 'number' ? other.targetX : other.currentX;
                    const otherY = typeof other.targetY === 'number' ? other.targetY : other.currentY;
                    const dx = this.targetX - otherX;
                    const dy = this.targetY - otherY;
                    const distance = Math.sqrt(dx * dx + dy * dy);

                    if (distance > 0 && distance < config.separationDistance) {
                        const strength = (config.separationDistance - distance) / config.separationDistance;
                        const normX = dx / distance;
                        const normY = dy / distance;
                        separationX += normX * strength;
                        separationY += normY * strength;
                    }
                }

                if (separationX !== 0 || separationY !== 0) {
                    const separationMagnitude = Math.sqrt(separationX * separationX + separationY * separationY);
                    if (separationMagnitude > 0) {
                        const limitedMagnitude = Math.min(separationMagnitude, 1);
                        const force = config.separationStrength * config.maxDistance * limitedMagnitude;
                        this.targetX += (separationX / separationMagnitude) * force;
                        this.targetY += (separationY / separationMagnitude) * force;
                    }
                }
            }

            // キャンバス外へ出ないようにクランプ（上下で異なる制限を適用）
            this.targetX = Math.max(centerX - distanceBounds.widthLimit, Math.min(centerX + distanceBounds.widthLimit, this.targetX));
            this.targetY = Math.max(centerY - distanceBounds.heightLimitTop, Math.min(centerY + distanceBounds.heightLimitBottom, this.targetY));

            // 緩やかに目標位置へ補間
            this.currentX += (this.targetX - this.currentX) * config.moveSmoothing;
            this.currentY += (this.targetY - this.currentY) * config.moveSmoothing;

            this.x = this.currentX;
            this.y = this.currentY;

            // 浮遊角度を更新
            this.floatAngle += this.floatSpeed;
        }

        // イージング関数（ease-out-cubic）
        easeOutCubic(t) {
            return 1 - Math.pow(1 - t, 3);
        }

        draw() {
            // 深度に応じた透明度（奥ほど薄く、よりコントラスト強く）
            const depthOpacity = 0.2 + this.depth * 0.8; // 0.32-1.0
            const finalOpacity = this.opacity * depthOpacity;

            // ノードを描画（深度に応じたサイズ）
            ctx.globalAlpha = finalOpacity;
            ctx.beginPath();
            ctx.arc(this.x, this.y, this.radius, 0, Math.PI * 2);
            ctx.fillStyle = config.nodeColor;
            ctx.fill();

            // アウトライン（手前のノードほど強調、より動的に）
            if (this.opacity > 0.9 && this.depth > 0.6) {
                ctx.strokeStyle = config.nodeColor;
                ctx.lineWidth = 1.5 * this.depth;
                ctx.globalAlpha = finalOpacity * 0.5; // 少し濃く
                ctx.stroke();
            }

            ctx.globalAlpha = 1;
        }
    }

    // 初期化
    function init() {
        resize();
        createNodes();
        animate();

        window.addEventListener('resize', resize);
    }

    // リサイズ処理
    function resize() {
        const container = canvas.parentElement;
        width = canvas.width = container.clientWidth;
        height = canvas.height = container.clientHeight;
        centerX = width / 2;
        centerY = height / 2;
        applyResponsiveSettings();
        updateDistanceBounds();
    }

    // 初期ノード生成
    function createNodes() {
        nodes = [];
        const minDistance = distanceBounds.min;
        const maxDistance = distanceBounds.max;
        const distanceRange = Math.max(maxDistance - minDistance, maxDistance * 0.25);
        const startTime = Date.now();

        for (let i = 0; i < config.initialNodes; i++) {
            let angle;
            if (config.avoidCenter) {
                // スマホ：上下のエリアに配置（中央を避ける）
                const topOrBottom = Math.random() < 0.5;
                if (topOrBottom) {
                    // 上部: 210度〜330度（下半分を除外）
                    angle = (Math.PI * 210 / 180) + Math.random() * (Math.PI * 120 / 180);
                } else {
                    // 下部: 30度〜150度（上半分を除外）
                    angle = (Math.PI * 30 / 180) + Math.random() * (Math.PI * 120 / 180);
                }
            } else {
                angle = (Math.PI * 2 / config.initialNodes) * i + Math.random() * 0.3;
            }
            const distance = Math.min(minDistance + Math.random() * distanceRange, maxDistance);
            nodes.push(new Node(angle, distance, i, startTime));
        }
        lastNodeAddedAt = Date.now();
    }

    // ノードを1つ追加
    function addNode() {
        if (nodes.length >= config.maxNodes) return;

        const minDistance = distanceBounds.min;
        const maxDistance = distanceBounds.max;
        const distanceRange = Math.max(maxDistance - minDistance, maxDistance * 0.25);

        let angle;
        if (config.avoidCenter) {
            // スマホ：上下のエリアに配置（中央を避ける）
            const topOrBottom = Math.random() < 0.5;
            if (topOrBottom) {
                angle = (Math.PI * 210 / 180) + Math.random() * (Math.PI * 120 / 180);
            } else {
                angle = (Math.PI * 30 / 180) + Math.random() * (Math.PI * 120 / 180);
            }
        } else {
            angle = Math.random() * Math.PI * 2;
        }
        const distance = Math.min(minDistance + Math.random() * distanceRange, maxDistance);

        nodes.push(new Node(angle, distance, nodes.length, Date.now()));
        lastNodeAddedAt = Date.now();
    }

    // 線を描画
    function drawConnections() {
        for (let i = 0; i < nodes.length; i++) {
            for (let j = i + 1; j < nodes.length; j++) {
                const dx = nodes[i].x - nodes[j].x;
                const dy = nodes[i].y - nodes[j].y;
                const distance = Math.sqrt(dx * dx + dy * dy);

                if (distance < config.maxDistance) {
                    const nodeOpacity = Math.min(nodes[i].opacity, nodes[j].opacity);
                    const lineOpacity = Math.min(nodes[i].lineOpacity, nodes[j].lineOpacity); // 線専用の透明度

                    // 線がまだ表示されていない場合はスキップ
                    if (lineOpacity <= 0) continue;

                    // 両端のノードの平均深度を計算
                    const avgDepth = (nodes[i].depth + nodes[j].depth) / 2;

                    // 深度に応じた線の透明度（奥ほど薄く）
                    const depthOpacity = config.minLineOpacity + (config.maxLineOpacity - config.minLineOpacity) * avgDepth;
                    const distanceFactor = 1 - distance / config.maxDistance;
                    const opacity = distanceFactor * depthOpacity * nodeOpacity * lineOpacity; // lineOpacityを追加

                    // 深度に応じた線の太さ（奥ほど細く）
                    const lineWidth = config.minLineWidth + (config.maxLineWidth - config.minLineWidth) * avgDepth;

                    ctx.beginPath();
                    ctx.moveTo(nodes[i].x, nodes[i].y);
                    ctx.lineTo(nodes[j].x, nodes[j].y);
                    ctx.strokeStyle = config.lineColor;
                    ctx.globalAlpha = opacity;
                    ctx.lineWidth = lineWidth;
                    ctx.stroke();
                    ctx.globalAlpha = 1;
                }
            }
        }
    }

    // マウスイベント
    function handleMouseMove(e) {
        const rect = canvas.getBoundingClientRect();
        mouse.x = e.clientX - rect.left;
        mouse.y = e.clientY - rect.top;
    }

    function handleMouseLeave() {
        mouse.x = null;
        mouse.y = null;
    }

    // アニメーションループ
    function animate(timestamp) {
        ctx.clearRect(0, 0, width, height);

        // 進行度を更新（最初の3秒で0→1、その後は1を維持）
        if (progress < 1) {
            progress += 1 / (config.expandDuration / 16.67); // 60fps想定
            progress = Math.min(progress, 1);
        }

        // 定期的にノードを追加
        if (nodes.length < config.maxNodes) {
            nodeSpawnTimer += 16.67; // 約60fps
            if (nodeSpawnTimer >= config.nodeSpawnInterval) {
                addNode();
                nodeSpawnTimer = 0;
            }
        }

        // ノード位置を更新
        const lockMovement = shouldLockNodes();
        nodes.forEach(node => node.updatePosition(nodes, lockMovement));

        // 深度順にソート（奥から手前に描画するため）
        const sortedNodes = [...nodes].sort((a, b) => a.depth - b.depth);

        // 線を描画（奥から手前へ）
        drawConnections();

        // ノードを描画（奥から手前へ）
        sortedNodes.forEach(node => node.draw());

        animationId = requestAnimationFrame(animate);
    }

    // ページ読み込み時に初期化
    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', init);
    } else {
        init();
    }

    // マウスイベントリスナー
    canvas.addEventListener('mousemove', handleMouseMove);
    canvas.addEventListener('mouseleave', handleMouseLeave);

    // クリーンアップ
    window.addEventListener('beforeunload', () => {
        if (animationId) {
            cancelAnimationFrame(animationId);
        }
        canvas.removeEventListener('mousemove', handleMouseMove);
        canvas.removeEventListener('mouseleave', handleMouseLeave);
    });

})();
