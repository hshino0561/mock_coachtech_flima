document.addEventListener('DOMContentLoaded', function () {
    const selectBox = document.querySelector('.payment-select');
    const selected = selectBox.querySelector('.selected-label');
    const options = selectBox.querySelector('.options');
    const items = options.querySelectorAll('li');
    const hiddenInput = document.getElementById('payment_input');
    const display = document.querySelector('.payment-value');

    // sessionStorageから復元
    const savedValue = sessionStorage.getItem('payment_method');
    if (savedValue) {
        items.forEach(item => {
            if (item.dataset.value === savedValue) {
                const label = item.querySelector('.label')?.textContent || item.textContent;
                selected.textContent = label;
                selected.classList.remove('selected-label--placeholder');
                display.textContent = label;
                hiddenInput.value = savedValue;
                item.classList.add('selected');
                const check = item.querySelector('.check');
                if (check) check.textContent = '✓';
            }
        });
    }

    // 開閉
    selectBox.addEventListener('click', () => {
        selectBox.classList.toggle('open');
    });

    // 選択肢クリック
    items.forEach(item => {
        item.addEventListener('click', e => {
            e.stopPropagation();
            const label = item.querySelector('.label')?.textContent || item.textContent;
            selected.textContent = label;
            hiddenInput.value = item.dataset.value;
            if (display) display.textContent = label;

            // 選択状態をクリアして更新
            items.forEach(i => {
                i.classList.remove('selected');
                const check = i.querySelector('.check');
                if (check) check.textContent = '';
            });
            item.classList.add('selected');
            const check = item.querySelector('.check');
            if (check) check.textContent = '✓';
            selected.classList.remove('selected-label--placeholder');
            selectBox.classList.remove('open');

            // sessionStorageに保存
            sessionStorage.setItem('payment_method', item.dataset.value);
        });
    });

    // 外部クリックで閉じる
    document.addEventListener('click', e => {
        if (!selectBox.contains(e.target)) {
            selectBox.classList.remove('open');
        }
    });
});
