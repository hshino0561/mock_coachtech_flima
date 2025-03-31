// 支払い方法が選択されたときに右側に反映
document.getElementById('payment-select').addEventListener('change', function() {
    document.getElementById('payment-method-display').textContent = this.value;
});
