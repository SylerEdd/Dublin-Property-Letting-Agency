const popupOverlay = document.querySelector(".popup-overlay");
const skip = document.querySelector(".popup-overlay .skip");
const visitButton = document.querySelector(".popup-overlay .visit-button ");

let remainingTime = 5;
let allowedToSkip = false;
let popupTimer;

const  createPopupCookie =() =>{
    let expiresDays = 7;
    let date = new Date ();
    date.setTime(date.getTime() + expiresDays * 24 *  60 * 60 * 1000);
    let expires = "expires=" + date.toUTCString();
    document.cookie = `popupCookie=true; ${expires}; path=/;`;
}

const showAd = () => {
   {
        popupOverlay.classList.add("active");
        popupTimer = setInterval(()=> {
            skip.innerHTML = `Skip in ${remainingTime}s`;
            remainingTime--;
            if(remainingTime < 0){
                allowedToSkip = true;
                skip.innerHTML= "SKip";
                clearInterval(popupTimer);
            }
        }, 1000);
    }
};
const skipAd = () =>{
    popupOverlay.classList.remove("active");
    createPopupCookie();

};
skip.addEventListener("click",() =>{
    if(allowedToSkip){
        skipAd();

    }
});
const startTimer = () => { 
    if(window.scrollY >100){
        showAd();
        window.removeEventListener("scroll", startTimer);
    }
};
if (!document.cookie.match(/^(.*;)?\s*popupCookie\s*=\s*[^;]+(.*)?$/)) {
window.addEventListener("scroll",startTimer);

}

