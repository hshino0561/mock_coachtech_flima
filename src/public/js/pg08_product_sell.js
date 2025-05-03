document.addEventListener('DOMContentLoaded', () => {
    // ? カテゴリ選択処理
    const categoryTags = document.querySelectorAll('.category-tag');
    const selectedInput = document.getElementById('selectedCategories');
    let selectedIds = [];

    // 初期値の復元（バリデーション後）
    if (selectedInput && selectedInput.value) {
        selectedIds = selectedInput.value.split(',');
        categoryTags.forEach(tag => {
            const id = tag.dataset.id;
            if (selectedIds.includes(id)) {
                tag.classList.add('selected');
            }
        });
    }

    categoryTags.forEach(tag => {
        tag.addEventListener('click', () => {
            const id = tag.dataset.id;

            if (tag.classList.contains('selected')) {
                tag.classList.remove('selected');
                const index = selectedIds.indexOf(id);
                if (index > -1) selectedIds.splice(index, 1);
            } else {
                tag.classList.add('selected');
                selectedIds.push(id);
            }

            selectedInput.value = selectedIds.join(',');
        });
    });

    // ? 商品状態（カスタムセレクト）処理
    const select = document.getElementById('customSelect');
    if (select) {
        const selected = select.querySelector('.selected');
        const options = select.querySelectorAll('.options li');
        const hiddenInput = document.getElementById('conditionInput');

        // 初期状態の復元
        if (hiddenInput.value) {
            options.forEach(option => {
                if (option.dataset.id === hiddenInput.value) {
                    selected.textContent = option.textContent;
                    selected.classList.add('selected-option');
                    selected.style.color = '#000';
                    option.classList.add('selected-option');
                }
            });
        }

        // セレクトボックス開閉（liクリックではトグルさせない）
        select.addEventListener('click', (e) => {
            if (e.target.tagName.toLowerCase() === 'li') return;
            select.classList.toggle('open');
        });

        // 選択時に即閉じ
        options.forEach(option => {
            option.addEventListener('click', (e) => {
                e.stopPropagation();

                options.forEach(o => o.classList.remove('selected-option'));
                option.classList.add('selected-option');

                selected.textContent = option.textContent;
                selected.style.color = '#000';
                hiddenInput.value = option.dataset.id;

                select.classList.remove('open'); // ? 即閉じる
            });
        });

        // 外部クリックで閉じる
        document.addEventListener('click', (e) => {
            if (!select.contains(e.target)) {
                select.classList.remove('open');
            }
        });

        // デバッグログ（開発用）
        console.log('[DEBUG] 初期状態の condition_id:', hiddenInput.value);
        document.querySelector('form').addEventListener('submit', function () {
            console.log('[DEBUG] 送信前の condition_id:', hiddenInput.value);
        });
    }

    // ? 画像プレビュー処理
    const fileInput = document.getElementById('product-image');
    const previewImage = document.getElementById('imagePreview');
    const uploadText = document.getElementById('uploadText');
    const uploadArea = document.getElementById('imageUploadArea');

    if (fileInput && previewImage && uploadText) {
        fileInput.addEventListener('change', (event) => {
            const file = event.target.files[0];
            if (!file) return;

            const reader = new FileReader();
            reader.onload = function (e) {
                previewImage.src = e.target.result;
                previewImage.style.display = 'block';
                uploadText.style.display = 'none';
            };
            reader.readAsDataURL(file);
        });

        uploadArea.addEventListener('click', () => {
            fileInput.click();
        });
    }
});
