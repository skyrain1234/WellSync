// popup.js
const popup = document.getElementById('popup');
const popupConfirm = document.getElementById('popupConfirm');

popupConfirm.addEventListener('click', () => {
    popup.style.display = 'none';
});

export default {
    popup,
    popupConfirm
};
