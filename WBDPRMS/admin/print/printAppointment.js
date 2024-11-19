
function printTable() {
    const printContents = document.querySelector('.card').outerHTML;  // Select the entire card
    const originalContents = document.body.innerHTML;
    document.body.innerHTML = printContents;
    window.print();
    document.body.innerHTML = originalContents;
}