<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Client Partner Dashboard - GiftEase</title>
    <link rel="stylesheet" href="public/style.css" />
    <link rel="icon" type="image/png" href="resources/1.png">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

    <style>

        .wrap {
            display: grid;
            grid-template-columns: 1fr 360px;
            gap: 18px;
            padding: 18px;
            max-width: 1200px;
            margin: 20px auto
        }

        .panel {
            background: var(--card);
            padding: 14px;
            border-radius: 12px;
            box-shadow: 0 6px 18px rgba(18, 21, 46, 0.06)
        }

        .section {
            margin-bottom: 14px
        }

        .section h2 {
            margin: 0 0 8px 0;
            font-size: 14px
        }

        .grid {
            display: flex;
            flex-wrap: wrap;
            gap: 10px
        }

        .item {
            width: 120px;
            background: #fbfcff;
            border: 1px solid #eef2ff;
            padding: 8px;
            border-radius: 8px;
            text-align: center;
            cursor: pointer
        }

        .item img {
            width: 100%;
            height: 80px;
            object-fit: cover;
            border-radius: 6px
        }

        .item .label {
            font-size: 13px;
            margin-top: 6px
        }

        .item.selected {
            outline: 3px solid rgba(108, 92, 231, 0.14);
            transform: translateY(-4px)
        }

        .controls {
            display: flex;
            gap: 8px;
            align-items: center;
            justify-content: center;
            margin-top: 6px
        }

        button.btn {
            background: var(--accent);
            color: #fff;
            border: none;
            padding: 8px 12px;
            border-radius: 8px;
            cursor: pointer
        }

        button.ghost {
            background: transparent;
            border: 1px solid #ddd;
            color: var(--muted)
        }

        .qty {
            display: inline-flex;
            align-items: center;
            gap: 8px
        }

        .qty button {
            width: 28px;
            height: 28px;
            border-radius: 6px;
            border: 1px solid #e6e9f2;
            background: #fff;
            cursor: pointer
        }

        .preview {
            position: sticky;
            top: 20px;
            text-align: center;
            align-items: center;
            justify-content: center
        }

        .preview h3 {
            margin: 0 0 8px 0
        }

        .preview-canvas {
            position: relative;
            width: 260px;
            height: 260px;
            background: #fafbff;
            border-radius: 0px;
            border: 1px solid #e6e9f2;
            overflow: hidden;
            display: flex;
            align-items: center;
            justify-content: center
        }

        .preview-canvas img {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            max-width: 100%;
            max-height: 100%;
            pointer-events: none;
        }

        .footer-actions {
            display: flex;
            gap: 8px;
            justify-content: space-between;
            align-items: center;
            margin-top: 12px
        }

        .export {
            padding: 8px 10px;
            border-radius: 8px;
            border: 1px dashed #cbd5e1;
            background: transparent
        }

        .center-block {
            margin-left: auto;
            margin-right: auto;
            width: fit-content;
        }

        .clicked {
            border: 2px solid #e91e63;
            font-size: 1rem;
            outline: none;
            border-color: #e91e63;
        }

        pre.json {
            white-space: pre-wrap;
            word-break: break-word;
            background: #0f172a;
            color: #e6eef6;
            padding: 8px;
            border-radius: 8px;
            max-height: 180px;
            overflow: auto
        }

        #preview-list {
            margin-top: 10px;
            padding-top: 8px;
            border-top: 1px solid #e5e7eb;
            font-size: 14px;
        }

        .preview-item,
        .preview-total {
            display: flex;
            justify-content: space-between;
            padding: 4px 0;
        }

        .preview-total {
            border-top: 1px dashed #ccc;
            margin-top: 6px;
            font-weight: 600;
        }


        @media (max-width:920px) {
            .wrap {
                grid-template-columns: 1fr;
                padding: 10px
            }

            .preview {
                position: relative
            }
        }
    </style>
</head>

<body>

    <div class="container">
        <?php
        $activePage = 'customize';
        include 'views/commonElements/leftSidebarDilma.php';
        ?>
        <div class="main-content">
            <div class="page-header">
                <h1 class="title">Customize Order</h1>
                <p class="subtitle">Personalize your products with custom options</p>
            </div>

            <main class="wrap">
                <section class="panel">
                    <div class="section">
                        <h2>Choose Base</h2>
                        <select id="base-filter" class="dropdown">
                            <option value="giftbox">Gift Boxes</option>
                            <option value="giftbag">Gift Bags</option>
                        </select>
                    </div>

                    <div class="section" id="box-section">
                        <h2>1) Choose a Giftbox</h2>
                        <div class="grid" id="box-grid"></div>
                    </div>

                    <div class="section" id="boxdecor-section">
                        <h2>2) Decorative additions (Box)</h2>
                        <div class="grid" id="boxdecor-grid"></div>
                    </div>

                    <div class="section" id="bag-section">
                        <h2>1) Choose a Giftbag</h2>
                        <div class="grid" id="bag-grid"></div>
                    </div>

                    <div class="section" id="bagdecor-section">
                        <h2>2) Decorative additions (Bag)</h2>
                        <div class="grid" id="bagdecor-grid"></div>
                    </div>

                    <div class="section" id="softtoy-section">
                        <h2>3) Soft Toys</h2>
                        <div class="grid" id="softToy-grid"></div>
                    </div>

                    <div class="section" id="chocolate-section">
                        <h2>4) Chocolates</h2>
                        <div class="grid" id="chocolate-grid"></div>
                    </div>

                    <div class="section" id="cards-section">
                        <h2>5) Cards</h2>
                        <div class="grid" id="cards-grid"></div>
                    </div>

                    <div style="display:flex;gap:8px;margin-top:12px;align-items:center">
                        <button class="btn" id="reset-btn">Reset</button>
                        <button class="ghost" id="random-btn">Surprise me</button>
                    </div>
                </section>

                <aside class="panel preview">
                    <h3>Layered Preview</h3>

                    <div class="center-block">
                        <div class="preview-canvas" id="preview-canvas"></div>
                    </div>
                    <div class="preview-list" id="preview-list">
                        <p style="color:var(--muted);font-size:13px">No selections yet — choose a base to start.</p>
                    </div>
                    <form id="customizeForm" method="POST" action="?controller=client&action=dashboard/custom">
                        <input type="hidden" name="array" id="selectionArray">
                        <button type="submit" class="btn2">Place Order</button>
                    </form>
                </aside>
            </main>
        </div>
    </div>

    <script>
        const baseFilter = document.getElementById('base-filter');

        // Get PHP data (safe fallbacks to [])
        let boxWraps = <?php echo json_encode($boxWrap ?? []); ?>;
        let paperBags = <?php echo json_encode($paperBag ?? []); ?>;
        let paperBagdecors = <?php echo json_encode($paperBagRibbon ?? []); ?>;
        let boxdecors = <?php echo json_encode($boxRibbon ?? []); ?>;
        let softToys = <?php echo json_encode($softToys ?? []); ?>;
        let chocolates = <?php echo json_encode($chocolates ?? []); ?>;
        let cards = <?php echo json_encode($cards ?? []); ?>;
        let total = 0;

        console.log(boxWraps)
        console.log(paperBags)

        const SOFTTOYS = softToys;
        const CHOCOLATES = chocolates;
        const CARDS = cards;

        const state = { base: null, basedeco: null, softToy: null, chocolates: null, cards: null };

        function el(tag, attrs = {}, children = '') {
            const e = document.createElement(tag);
            Object.entries(attrs).forEach(([k, v]) => {
                if (k === 'class') e.className = v;
                else e.setAttribute(k, v);
            });
            if (children) e.innerHTML = children;
            return e;
        }

        function renderGrid(list, container, onClick, key) {
            container.innerHTML = '';
            list.forEach(item => {
                const card = el('div', { class: 'item', 'data-id': item.id });
                card.innerHTML = `<img src="${item.displayImage}"><div class="label">${item.name}</div>`;

                // ✅ Add 'clicked' only if this item's ID matches that category's selected state
                if (state[key] && state[key].id === item.id) {
                    card.classList.add('clicked');
                }

                // ✅ When clicked: toggle selection and re-render only this grid
                card.onclick = () => {
                    onClick(item);
                    renderGrid(list, container, onClick, key);
                };

                container.appendChild(card);
            });
        }




        function selectBase(item) { state.base = item; renderPreview(); }
        function selectBaseDecor(item) {
            state.basedeco = (state.basedeco && state.basedeco.id == item.id) ? null : item;
            renderPreview();
        }
        function selectSoftToy(item) {
            state.softToy = (state.softToy && state.softToy.id == item.id) ? null : item;
            renderPreview();
        }
        function selectChocolate(item) {
            state.chocolates = (state.chocolates && state.chocolates.id == item.id) ? null : item;
            renderPreview();
        }
        function selectCard(item) {
            state.cards = (state.cards && state.cards.id == item.id) ? null : item;
            renderPreview();
        }


        function renderPreview() {
            const canvas = document.getElementById('preview-canvas');
            const listDiv = document.getElementById('preview-list');
            const jsonView = document.getElementById('json-view');

            canvas.innerHTML = '';
            listDiv.innerHTML = '';

            const imgs = [];
            const selectedItems = [];

            // Gather selected items
            if (state.base) selectedItems.push(state.base);
            if (state.basedeco) selectedItems.push(state.basedeco);
            if (state.softToy) selectedItems.push(state.softToy);
            if (state.chocolates) selectedItems.push(state.chocolates);
            if (state.cards) selectedItems.push(state.cards);

            imgs.push(...selectedItems);
            imgs.sort((a, b) => (a.layer || 0) - (b.layer || 0));

            imgs.forEach(i => {
                const imgSrc = i.previewImage || i.displayImage;
                if (imgSrc) {
                    const im = el('img', {
                        src: imgSrc,
                        alt: i.name,
                        style: `z-index:${i.layer || 1}`
                    });
                    canvas.appendChild(im);
                }
            });

            // ✅ Render item list + calculate total
            totalPrice = 0;
            if (selectedItems.length > 0) {
                selectedItems.forEach(item => {
                    const price = parseFloat(item.price) || 0;
                    totalPrice += price;

                    const row = el('div', { class: 'preview-item' },
                        `<span>${item.name}</span><span style="margin-left:auto;">Rs ${price.toFixed(2)}</span>`
                    );
                    listDiv.appendChild(row);
                });

                const totalRow = el('div', { class: 'preview-total' },
                    `<strong>Total:</strong><strong style="margin-left:auto;">Rs ${totalPrice.toFixed(2)}</strong>`
                );
                listDiv.appendChild(totalRow);
            } else {
                listDiv.innerHTML = `<p style="color:var(--muted);font-size:13px">No selections yet — choose a base to start.</p>`;
            }

            jsonView.textContent = JSON.stringify(state, null, 2);
        }



        // 👉 function to render everything depending on dropdown selection
        function renderBaseOptions() {
            const isGiftBox = baseFilter.value === 'giftbox';
            const BASE = isGiftBox ? boxWraps : paperBags;
            const BASEDECO = isGiftBox ? boxdecors : paperBagdecors;

            // Show/hide sections accordingly
            document.getElementById('box-section').style.display = isGiftBox ? 'block' : 'none';
            document.getElementById('boxdecor-section').style.display = isGiftBox ? 'block' : 'none';
            document.getElementById('bag-section').style.display = isGiftBox ? 'none' : 'block';
            document.getElementById('bagdecor-section').style.display = isGiftBox ? 'none' : 'block';

            // Render appropriate grids
            renderGrid(BASE, document.getElementById(isGiftBox ? 'box-grid' : 'bag-grid'), selectBase, 'base');
            renderGrid(BASEDECO, document.getElementById(isGiftBox ? 'boxdecor-grid' : 'bagdecor-grid'), selectBaseDecor, 'basedeco');
        }

        document.addEventListener('DOMContentLoaded', () => {
            renderBaseOptions(); // initial render

            renderGrid(SOFTTOYS, document.getElementById('softToy-grid'), selectSoftToy, 'softToy');
            renderGrid(CHOCOLATES, document.getElementById('chocolate-grid'), selectChocolate, 'chocolates');
            renderGrid(CARDS, document.getElementById('cards-grid'), selectCard, 'cards');


            // ✅ Listen for dropdown changes
            baseFilter.addEventListener('change', () => {
                // Reset only base and base decor on switch
                state.base = null;
                state.basedeco = null;
                renderBaseOptions();
                renderPreview();
            });

            document.getElementById('reset-btn').onclick = () => {
                Object.keys(state).forEach(k => state[k] = null);
                renderPreview();
            };

            document.getElementById('random-btn').onclick = () => {
                const isGiftBox = baseFilter.value === 'giftbox';
                const BASE = isGiftBox ? boxWraps : paperBags;
                const BASEDECO = isGiftBox ? boxdecors : paperBagdecors;

                if (BASE.length) state.base = BASE[Math.floor(Math.random() * BASE.length)];
                if (BASEDECO.length) state.basedeco = BASEDECO[Math.floor(Math.random() * BASEDECO.length)];
                if (CHOCOLATES.length) state.chocolates = CHOCOLATES[Math.floor(Math.random() * CHOCOLATES.length)];
                if (SOFTTOYS.length) state.softToy = SOFTTOYS[Math.floor(Math.random() * SOFTTOYS.length)];
                if (CARDS.length) state.cards = CARDS[Math.floor(Math.random() * CARDS.length)];
                renderPreview();
            };

            renderPreview();
        });

        document.getElementById('customizeForm').addEventListener('submit', (e) => {
            // Build the payload object
            const data = {
                box: baseFilter.value === 'giftbox' && state.base ? state.base.id : null,
                boxDeco: baseFilter.value === 'giftbox' && state.basedeco ? state.basedeco.id : null,
                paper: baseFilter.value === 'giftbag' && state.base ? state.base.id : null,
                paperDeco: baseFilter.value === 'giftbag' && state.basedeco ? state.basedeco.id : null,
                chocolate: state.chocolates ? state.chocolates.id : null,
                card: state.cards ? state.cards.id : null,
                softToy: state.softToy ? state.softToy.id : null,
                totalPrice: totalPrice.toFixed(2)
            };

            // Convert it to JSON string
            document.getElementById('selectionArray').value = JSON.stringify(data);

            // Optional: log it before submission
            console.log("Submitting:", data);
        });

    </script>


</body>

</html>