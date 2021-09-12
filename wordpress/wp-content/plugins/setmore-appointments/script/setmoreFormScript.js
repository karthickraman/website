window.onload = function () {
	var bookingPageUrl = document.querySelector("#setmore_booking_page_url").value;

	if (bookingPageUrl && bookingPageUrl != "https://my.setmore.com" && bookingPageUrl != null && bookingPageUrl != "") {
		document.querySelector("#third").style.display = "block";
		document.querySelector("#connectBlock").style.display = "none";
	}
	else {
		document.querySelector("#third").style.display = "none";
		document.querySelector("#connectBlock").style.display = "block";
	}
	var dropDownMenu = document.querySelector('.g-dropdown-wrap');
	
	var langList = document.querySelectorAll('.dropDonwList li');

	for (var i = 0; i < langList.length; i++) {
		langList[i].onclick = function () {
			document.querySelector("#third .g-dropdown-wrap .g-drop-btn span").innerText = this.textContent;
			dropDownMenu.classList.remove("open");
			saveBookingPageConfiguration(null,this.textContent);
		}
	}

	

	document.addEventListener("click", function (event) {
		if (event.target.className == "g-drop-arrow") {
			dropDownMenu.classList.add("open");
		} else {
			dropDownMenu.classList.remove("open");
		}
	});

	var copyToClipboard = function(secretInfo) {
        var customSetmoreUrlInput = document.createElement('INPUT');
        document.body.appendChild(customSetmoreUrlInput);
        customSetmoreUrlInput.setAttribute('value', secretInfo);
        customSetmoreUrlInput.select();
		customSetmoreUrlInput.setSelectionRange(0, 99999)
        document.execCommand('copy');
        document.body.removeChild(customSetmoreUrlInput);
    }
	document.querySelector("#edit_option").onclick = function(){
		let editEle = (event.target.tagName == "svg") ? (event.target.parentNode) : (event.target);
		if(editEle){
			document.getElementById("edit_booking_page_url").style.display = "block";
			document.getElementById("booking_page_url").style.display = "none";
		}
	}
	document.querySelector("#text_booking_page_url").onblur = function(){
		let editedBookingPageUrl = event.target.value;
		saveBookingPageConfiguration(editedBookingPageUrl,null);
	}
	document.querySelectorAll('.copy_setmorewp_url').forEach(item => {
		item.addEventListener('click', event => {
			let copyele = (event.target.tagName == "svg") ?event.target.parentNode : event.target;
			copyele.removeAttribute("data-tips");
			copyele.setAttribute("data-tips","Copy");
			let secretInfo = "https://my.setmore.com";
			if(copyele && copyele.classList.contains("mr-1")){
				secretInfo = event.target.parentNode.parentNode.querySelector("#booking_page_url").href;
			}
			copyToClipboard(secretInfo);
			copyele.setAttribute("data-tips","Copied");
		})
	})
	function saveBookingPageConfiguration(setmoreBookingPageURl,languageOption){
		if(setmoreBookingPageURl){
			document.querySelector("#setmore_booking_page_url").value = setmoreBookingPageURl;
		}
		if(languageOption){
			document.querySelector("#languageOption").value = languageOption;
		}
		document.querySelector("#submit").click();
	}

	[document.querySelector("#login"),document.querySelector("#signup")].forEach(setmoreButton => {
		setmoreButton.addEventListener('click', event => {
		  setmoreButtonHandler(event);
		})
	  })

	function setmoreButtonHandler(event) {
		var siteUrl = event.target.getAttribute("siteurl");
		var windowWidth  = 520;
		var windowHeight = 680;
		var posLeft = (window.screen.width / 2) - ((windowWidth / 2) + 10);
	    var posTop = (window.screen.height / 2) - ((windowHeight / 2) + 20);  
			var setmoreLiveUrl = "https://my.setmore.com/integration/wordpress/oauth?siteUrl="+siteUrl;
		if(event.target.id === "signup")   {
			setmoreLiveUrl = "https://www.setmore.com/integrations-start-now?source=wordpress&redirectUrl="+siteUrl+"&utm_source=wordpress%20plugin%20internal&utm_medium=integrations&utm_campaign=wp_plugin_internal_signup";
		}
		var popupWindow = window.open(setmoreLiveUrl, "_blank", 'scrollbars=yes,resizable=0,width='+windowWidth+', height='+windowHeight+', top='+posTop+', left='+posLeft+'');
		popupWindow.focus();
		var pollTimer = window.setInterval(function () {
			console.log('the popupwindow', popupWindow.location.href);
			if (popupWindow.location.href.indexOf("status=true") != -1) {
				const urlParams = new URLSearchParams(popupWindow.location.search);
				document.querySelector("#third").style.display = "none";
				document.querySelector("#connectBlock").style.display = "none";
				saveBookingPageConfiguration(urlParams.get("bookingpageurl"),"English");
				window.clearInterval(pollTimer);
				popupWindow.close();
			}
		}, 1000);
	}
}



