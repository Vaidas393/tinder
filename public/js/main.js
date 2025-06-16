window.onload = () => {
  let preloader = document.getElementById("preloader");
  if (preloader) {
    setTimeout(function () {
      preloader.style.transform = "translateY(-100%)";
    }, 500);
  }

  // welcome slider
  let welcomeSlider = document.querySelector(".welcome-slide");
  if (welcomeSlider) {
    var swiper = new Swiper(welcomeSlider, {
      slidesPerView: 1,
      effect: 'fade',
      speed: 2000,
      parallax: true,
      autoplay: {
        delay: 10000,
      },
      pagination: {
        el: ".welcome-pagination",
        clickable: true,
      },
      navigation: {
        nextEl: ".welcome-swiper-next",
      },
    });
  }

  // toggle password
  let passwordToggleBtn = document.querySelector('.toggle-password')
  let inputPassword = document.querySelector('#password')
  if (passwordToggleBtn) {
    passwordToggleBtn.addEventListener('click', () => {
      if (password.type == 'password') {
        password.setAttribute('type', 'text');
        passwordToggleBtn.classList.remove('bi-eye');
        passwordToggleBtn.classList.add('bi-eye-slash');
      } else {
        password.setAttribute('type', 'password');
        passwordToggleBtn.classList.remove('bi-eye-slash');
        passwordToggleBtn.classList.add('bi-eye');
      }
    })
  }

  // password strength check
  let passwordStrength = document.getElementsByClassName('check-strength')[0];
  let showStrengthRange = document.getElementsByClassName('password-strength-group')[0];
  if (passwordStrength) {
    passwordStrength.addEventListener('keyup', (event) => {
      let value = event.target.value
      let passwordStrengthValue = passwordStrengthChecker(value)
      showPasswordStrength(passwordStrengthValue)
    })
  }
  // password strength checker
  function passwordStrengthChecker(pass) {
    let count = 0;
    let regex1 = /[a-z]/;
    if (regex1.test(pass)) count++;
    let regex2 = /[A-Z]/;
    if (regex2.test(pass)) count++;
    let regex3 = /[\d]/;
    if (regex3.test(pass)) count++;
    let regex4 = /[!@#$%^&*.?]/;
    if (regex4.test(pass)) count++;
    return count
  }
  //show passwordStrength range
  function showPasswordStrength(strengthValue) {
    showStrengthRange.setAttribute('data-strength', strengthValue)
  }

  // color switch btn
  const cmnThm = document.getElementById("theme-mode");
  let body = document.querySelector("body");
  let darkMode = localStorage.getItem("dark-mode");

  if (cmnThm) {
    var switchWrapper = cmnThm.querySelector(".checkbox");
    switchWrapper.addEventListener("click", () => {
      darkMode = localStorage.getItem("dark-mode");
      if (darkMode === "disabled") {
        enableDarkMode();
      } else {
        disableDarkMode();
      }
    })
  }
  const enableDarkMode = () => {
    body.classList.add("dark-theme");
    localStorage.setItem("dark-mode", "enabled");
    if (switchWrapper) {
      switchWrapper.setAttribute('checked', true)
    }
  };
  const disableDarkMode = () => {
    body.classList.remove("dark-theme");
    localStorage.setItem("dark-mode", "disabled");
    if (switchWrapper) {
      switchWrapper.setAttribute('checked', false)
    }
  };
  if (darkMode === "enabled") {
    enableDarkMode();
  }

  // COUNTRY LIST ARRAY Object
  const countryList = [
    {
      flag: './assets/img/flag/af.png',
      countryName: "Afghanistan",
      checked: false,
    },
    {
      flag: './assets/img/flag/al.png',
      countryName: "Albania",
      checked: false,
    },
    {
      flag: './assets/img/flag/ad.png',
      countryName: "Algeria",
      checked: false,
    },
    {
      flag: './assets/img/flag/am.png',
      countryName: "American",
      checked: false,
    },
    {
      flag: './assets/img/flag/af.png',
      countryName: "Antarctica",
      checked: false,
    },
    {
      flag: './assets/img/flag/af.png',
      countryName: "Antigua and Barbuda",
      checked: false,
    },
    {
      flag: './assets/img/flag/af.png',
      countryName: "Argentina",
      checked: false,
    },
    {
      flag: './assets/img/flag/af.png',
      countryName: "Armenia",
      checked: false,
    },
    {
      flag: './assets/img/flag/af.png',
      countryName: "Australia",
      checked: false,
    },
    {
      flag: './assets/img/flag/af.png',
      countryName: "Austria",
      checked: false,
    },
    {
      flag: './assets/img/flag/af.png',
      countryName: "Azerbaijan",
      checked: false,
    },
    {
      flag: './assets/img/flag/af.png',
      countryName: "Bahamas",
      checked: false,
    },
    {
      flag: './assets/img/flag/af.png',
      countryName: "Bahrain",
      checked: false,
    },
    {
      flag: './assets/img/flag/af.png',
      countryName: "Bangladesh",
      checked: false,
    },
    {
      flag: './assets/img/flag/af.png',
      countryName: "Belarus",
      checked: false,
    },
    {
      flag: './assets/img/flag/af.png',
      countryName: "Belgium",
      checked: false,
    },
    {
      flag: './assets/img/flag/af.png',
      countryName: "Belize",
      checked: false,
    },
    {
      flag: './assets/img/flag/af.png',
      countryName: "Benin",
      checked: false,
    },
    {
      flag: './assets/img/flag/af.png',
      countryName: "Bermuda",
      checked: false,
    },
    {
      flag: './assets/img/flag/af.png',
      countryName: "Bhutan",
      checked: false,
    },
    {
      flag: './assets/img/flag/af.png',
      countryName: "Bonaire",
      checked: false,
    },
    {
      flag: './assets/img/flag/af.png',
      countryName: "Brazil",
      checked: false,
    },
    {
      flag: './assets/img/flag/af.png',
      countryName: "Bulgaria",
      checked: false,
    },
    {
      flag: './assets/img/flag/af.png',
      countryName: "Burundi",
      checked: false,
    },
    {
      flag: './assets/img/flag/af.png',
      countryName: "Cabo Verde",
      checked: false,
    },
    {
      flag: './assets/img/flag/af.png',
      countryName: "Cambodia",
      checked: false,
    },
    {
      flag: './assets/img/flag/af.png',
      countryName: "Cameroon",
      checked: false,
    },
    {
      flag: './assets/img/flag/af.png',
      countryName: "Canada",
      checked: false,
    },
    {
      flag: './assets/img/flag/af.png',
      countryName: "Chad",
      checked: false,
    },
    {
      flag: './assets/img/flag/af.png',
      countryName: "Chile",
      checked: false,
    },
    {
      flag: './assets/img/flag/af.png',
      countryName: "China",
      checked: false,
    },
    {
      flag: './assets/img/flag/af.png',
      countryName: "Christmas Island",
      checked: false,
    },
    {
      flag: './assets/img/flag/af.png',
      countryName: "Colombia",
      checked: false,
    },
    {
      flag: './assets/img/flag/af.png',
      countryName: "Congo",
      checked: false,
    },
    {
      flag: './assets/img/flag/af.png',
      countryName: "Ecuador",
      checked: false,
    },
    {
      flag: './assets/img/flag/af.png',
      countryName: "Egypt",
      checked: false,
    },
    {
      flag: './assets/img/flag/af.png',
      countryName: "Ethiopia",
      checked: false,
    },
    {
      flag: './assets/img/flag/af.png',
      countryName: "Fiji",
      checked: false,
    },
    {
      flag: './assets/img/flag/af.png',
      countryName: "Finland",
      checked: false,
    },
    {
      flag: './assets/img/flag/af.png',
      countryName: "France",
      checked: false,
    },
    {
      flag: './assets/img/flag/af.png',
      countryName: "French Guiana",
      checked: false,
    },
    {
      flag: './assets/img/flag/af.png',
      countryName: "French Polynesia",
      checked: false,
    },
    {
      flag: './assets/img/flag/af.png',
      countryName: "Gabon",
      checked: false,
    },
    {
      flag: './assets/img/flag/af.png',
      countryName: "Georgia",
      checked: false,
    },
    {
      flag: './assets/img/flag/af.png',
      countryName: "Germany",
      checked: false,
    },
    {
      flag: './assets/img/flag/af.png',
      countryName: "Ghana",
      checked: false,
    },
    {
      flag: './assets/img/flag/af.png',
      countryName: "Gibraltar",
      checked: false,
    },
    {
      flag: './assets/img/flag/af.png',
      countryName: "Greece",
      checked: false,
    },
    {
      flag: './assets/img/flag/af.png',
      countryName: "Greenland",
      checked: false,
    },
    {
      flag: './assets/img/flag/af.png',
      countryName: "Grenada",
      checked: false,
    },
    {
      flag: './assets/img/flag/af.png',
      countryName: "Guadeloupe",
      checked: false,
    },
    {
      flag: './assets/img/flag/af.png',
      countryName: "Guam",
      checked: false,
    },
    {
      flag: './assets/img/flag/af.png',
      countryName: "Guatemala",
      checked: false,
    },
    {
      flag: './assets/img/flag/af.png',
      countryName: "Guernsey",
      checked: false,
    },
    {
      flag: './assets/img/flag/af.png',
      countryName: "Guinea",
      checked: false,
    },
    {
      flag: './assets/img/flag/af.png',
      countryName: "Guinea-Bissau",
      checked: false,
    },
    {
      flag: './assets/img/flag/af.png',
      countryName: "Guyana",
      checked: false,
    },
    {
      flag: './assets/img/flag/af.png',
      countryName: "Haiti",
      checked: false,
    },
    {
      flag: './assets/img/flag/af.png',
      countryName: "Honduras",
      checked: false,
    },
    {
      flag: './assets/img/flag/af.png',
      countryName: "Hong Kong",
      checked: false,
    },
    {
      flag: './assets/img/flag/af.png',
      countryName: "Hungary",
      checked: false,
    },
    {
      flag: './assets/img/flag/af.png',
      countryName: "Iceland",
      checked: false,
    },
    {
      flag: './assets/img/flag/af.png',
      countryName: "India",
      checked: false,
    },
    {
      flag: './assets/img/flag/af.png',
      countryName: "Indonesia",
      checked: false,
    },
    {
      flag: './assets/img/flag/af.png',
      countryName: "Iran",
      checked: false,
    },
    {
      flag: './assets/img/flag/af.png',
      countryName: "Iraq",
      checked: false,
    },
    {
      flag: './assets/img/flag/af.png',
      countryName: "Kazakhstan",
      checked: false,
    },
    {
      flag: './assets/img/flag/af.png',
      countryName: "Kenya",
      checked: false,
    },
    {
      flag: './assets/img/flag/af.png',
      countryName: "Kiribati",
      checked: false,
    },
    {
      flag: './assets/img/flag/af.png',
      countryName: "Korea (the Democratic People's Republic of)",
      checked: false,
    },
    {
      flag: './assets/img/flag/af.png',
      countryName: "Korea (the Republic of)",
      checked: false,
    },
    {
      flag: './assets/img/flag/af.png',
      countryName: "Kuwait",
      checked: false,
    },
    {
      flag: './assets/img/flag/af.png',
      countryName: "Kyrgyzstan",
      checked: false,
    },
    {
      flag: './assets/img/flag/af.png',
      countryName: "Latvia",
      checked: false,
    },
    {
      flag: './assets/img/flag/af.png',
      countryName: "Lebanon",
      checked: false,
    },
    {
      flag: './assets/img/flag/af.png',
      countryName: "Lesotho",
      checked: false,
    },
    {
      flag: './assets/img/flag/af.png',
      countryName: "Liberia",
      checked: false,
    },
    {
      flag: './assets/img/flag/af.png',
      countryName: "Libya",
      checked: false,
    },
    {
      flag: './assets/img/flag/af.png',
      countryName: "Liechtenstein",
      checked: false,
    },
    {
      flag: './assets/img/flag/af.png',
      countryName: "Lithuania",
      checked: false,
    },
    {
      flag: './assets/img/flag/af.png',
      countryName: "Luxembourg",
      checked: false,
    },
    {
      flag: './assets/img/flag/af.png',
      countryName: "Macao",
      checked: false,
    },
    {
      flag: './assets/img/flag/af.png',
      countryName: "Madagascar",
      checked: false,
    },
    {
      flag: './assets/img/flag/af.png',
      countryName: "Malawi",
      checked: false,
    },
    {
      flag: './assets/img/flag/af.png',
      countryName: "Malaysia",
      checked: false,
    },
    {
      flag: './assets/img/flag/af.png',
      countryName: "Maldives",
      checked: false,
    },
    {
      flag: './assets/img/flag/af.png',
      countryName: "Mali",
      checked: false,
    },
    {
      flag: './assets/img/flag/af.png',
      countryName: "Malta",
      checked: false,
    },
    {
      flag: './assets/img/flag/af.png',
      countryName: "Martinique",
      checked: false,
    },
    {
      flag: './assets/img/flag/af.png',
      countryName: "Mauritania",
      checked: false,
    },
    {
      flag: './assets/img/flag/af.png',
      countryName: "Mauritius",
      checked: false,
    },
    {
      flag: './assets/img/flag/af.png',
      countryName: "Mayotte",
      checked: false,
    },
    {
      flag: './assets/img/flag/af.png',
      countryName: "Mexico",
      checked: false,
    },
    {
      flag: './assets/img/flag/af.png',
      countryName: "Moldova (the Republic of)",
      checked: false,
    },
    {
      flag: './assets/img/flag/af.png',
      countryName: "Namibia",
      checked: false,
    },
    {
      flag: './assets/img/flag/af.png',
      countryName: "Nauru",
      checked: false,
    },
    {
      flag: './assets/img/flag/af.png',
      countryName: "Nepal",
      checked: false,
    },
    {
      flag: './assets/img/flag/af.png',
      countryName: "Netherlands",
      checked: false,
    },
    {
      flag: './assets/img/flag/af.png',
      countryName: "Palestine",
      checked: false,
    },
    {
      flag: './assets/img/flag/af.png',
      countryName: "Panama",
      checked: false,
    },
    {
      flag: './assets/img/flag/af.png',
      countryName: "Papua New Guinea",
      checked: false,
    },
    {
      flag: './assets/img/flag/af.png',
      countryName: "Paraguay",
      checked: false,
    },
    {
      flag: './assets/img/flag/af.png',
      countryName: "Peru",
      checked: false,
    },
    {
      flag: './assets/img/flag/af.png',
      countryName: "Qatar",
      checked: false,
    },
    {
      flag: './assets/img/flag/af.png',
      countryName: "Romania",
      checked: false,
    },
    {
      flag: './assets/img/flag/af.png',
      countryName: "Pitcairn",
      checked: false,
    },
    {
      flag: './assets/img/flag/af.png',
      countryName: "Poland",
      checked: false,
    },
    {
      flag: './assets/img/flag/af.png',
      countryName: "Portugal",
      checked: false,
    },
    {
      flag: './assets/img/flag/af.png',
      countryName: "Saudi Arabia",
      checked: false,
    },
    {
      flag: './assets/img/flag/af.png',
      countryName: "Senegal",
      checked: false,
    },
    {
      flag: './assets/img/flag/af.png',
      countryName: "Serbia",
      checked: false,
    },
    {
      flag: './assets/img/flag/af.png',
      countryName: "Slovakia",
      checked: false,
    },
    {
      flag: './assets/img/flag/af.png',
      countryName: "Singapore",
      checked: false,
    },
    {
      flag: './assets/img/flag/af.png',
      countryName: "Slovenia",
      checked: false,
    },
    {
      flag: './assets/img/flag/af.png',
      countryName: "South Africa",
      checked: false,
    },
    {
      flag: './assets/img/flag/af.png',
      countryName: "Somalia",
      checked: false,
    },
    {
      flag: './assets/img/flag/af.png',
      countryName: "South Sudan",
      checked: false,
    },
    {
      flag: './assets/img/flag/af.png',
      countryName: "Spain",
      checked: false,
    },
    {
      flag: './assets/img/flag/af.png',
      countryName: "Sri Lanka",
      checked: false,
    },
    {
      flag: './assets/img/flag/af.png',
      countryName: "Sudan",
      checked: false,
    },
    {
      flag: './assets/img/flag/af.png',
      countryName: "Sweden",
      checked: false,
    },
    {
      flag: './assets/img/flag/af.png',
      countryName: "Switzerland",
      checked: false,
    },
    {
      flag: './assets/img/flag/af.png',
      countryName: "Taiwan",
      checked: false,
    },
    {
      flag: './assets/img/flag/af.png',
      countryName: "Tajikistan",
      checked: false,
    },
    {
      flag: './assets/img/flag/af.png',
      countryName: "Uruguay",
      checked: false,
    },
    {
      flag: './assets/img/flag/af.png',
      countryName: "Uzbekistan",
      checked: false,
    },
  ]
  // show and country select
  const listElem = document.querySelector('.country-list');
  if (listElem) {
    countryList.forEach(cntry => {
      let newLi = document.createElement('li');
      let Span = document.createElement('span');
      let Img = document.createElement('img');
      let Input = document.createElement('input');
      let div = document.createElement('div');

      newLi.append(div, Input);
      Img.setAttribute('src', `${cntry.flag}`)
      Img.setAttribute('alt', `${cntry.countryName}`)
      Span.append(`${cntry.countryName}`)
      Input.setAttribute('type', 'radio')
      Input.setAttribute('name', 'country')
      Input.setAttribute('value', `${cntry.countryName}`)
      div.append(Img, Span)
      listElem.appendChild(newLi);
    });
  }

  // search for country
  const listItems = document.querySelectorAll('.country-list li')
  const srchBox = document.querySelector('input');
  if (srchBox) {
    srchBox.addEventListener('input', function () {
      let filter = this.value.toLowerCase();
      listItems.forEach(item => {
        let itemTxt = (item.innerText || item.textContent).toLowerCase();
        if (itemTxt.indexOf(filter) > -1) {
          item.classList.remove('hide');
        } else { item.classList.add('hide'); };
      });
    });
  }

  listItems.forEach(item => {
    item.addEventListener('click', function () {
      const radioInput = item.querySelector('input[type="radio"]');
      radioInput.checked = true;
      listItems.forEach(it => it.classList.remove('country-select'));
      if (radioInput.checked === true) {
        let nextBtn = document.querySelector('#nextBtn')
        nextBtn.classList.remove('alt-btn-full2');
        item.classList.add('country-select');
      }
    })
  })

  // select option
  const selectOption = document.querySelectorAll('.select-option')
  selectOption.forEach(option => {
    option.addEventListener('click', function () {
      const radioInput = option.querySelector('input[type="radio"]');
      radioInput.checked = true;
      selectOption.forEach(it => it.classList.remove('option-selected'));
      if (radioInput.checked === true) {
        option.classList.add('option-selected');
      }
    });
  })

  // upload image
  let uploadImage = document.querySelectorAll('.upload');
  uploadImage.forEach(upload => {
    upload.addEventListener('click', function () {
      let InputFile = upload.querySelector('.input-file')
      InputFile.click();
      InputFile.addEventListener('change', function () {
        let previewImg = upload.querySelector('.preview-img')
        previewImg.src = URL.createObjectURL(InputFile.files[0])
        let plusButton = upload.querySelector('.plus-button')
        if (plusButton) {
          plusButton.style.visibility = 'hidden'
        }
        let btnPos = upload.querySelector('.upload-btn-area')
        if (btnPos) {
          btnPos.classList.add('alt')
        }
        let uploadButton = upload.querySelector('button');
        uploadButton.classList.add('alt')
        uploadButton.querySelector('span').innerText = 'Change'
        let cameraIcon = uploadButton.querySelector('.camera-icon')
        cameraIcon.style.display = 'block'
      })
    })
  })

  // progress bar
  let progressBar = document.querySelector('.progress-bar');
  if (progressBar) {
    progressBar.style.width = progressBar.getAttribute('data-value');
    // console.log(progressBar.getAttribute('data-value'));
  }

  let interest = document.querySelectorAll('.interest-area button')
  interest.forEach(item => {
    item.addEventListener('click', () => {
      item.classList.toggle('selected')
    });
  })

  // finished
  let finishedBtn = document.querySelector('.finished')
  let congratulation = document.querySelector('.congratulation')
  if (finishedBtn) {
    finishedBtn.addEventListener('click', () => {
      congratulation.style.display = 'block'
    });
  }

  // like star button
  let storyBtn = document.querySelectorAll('.story-btn')
  storyBtn.forEach(item => {
    item.addEventListener('click', () => {
      item.classList.toggle('alt')
    })
  })

  // story slider
  // let storySlider = document.querySelector(".story-slide");
  // if (storySlider) {
  //   var swiper = new Swiper(storySlider, {
  //     slidesPerView: 1,
  //     effect: "cards",
  //     grabCursor: true,
  //     autoplay: {
  //       delay: 10000,
  //     },
  //     pagination: {
  //       el: ".story-pagination",
  //       clickable: true,
  //     },
  //     navigation: {
  //       nextEl: ".story-swiper-next",
  //       prevEl: ".story-swiper-prev",
  //     },
  //   });
  // }

  // input range slider
  const minRange = document.getElementById("minRange");
  const maxRange = document.getElementById("maxRange");
  const minValue = document.getElementById("minValue");
  const maxValue = document.getElementById("maxValue");
  const rangeBar = document.getElementById("rangeBar");

  if (minRange && maxRange) {
    minRange.addEventListener("input", updateMinValue);
    maxRange.addEventListener("input", updateMaxValue);
  }
  function updateMinValue() {
    minValue.textContent = minRange.value;
    rangeBar.style.left = (minRange.value / minRange.max) * 100 + "%";
    minValue.style.left = (minRange.value / minRange.max) * 100 + "%";
    if (parseInt(minRange.value) > parseInt(maxRange.value)) {
      maxRange.value = minRange.value;
      updateMaxValue();
    }
  }
  function updateMaxValue() {
    maxValue.textContent = maxRange.value;
    rangeBar.style.right = 100 - ((maxRange.value / maxRange.max) * 100) + "%";
    maxValue.style.right = 100 - ((maxRange.value / maxRange.max) * 100) + "%";
    if (parseInt(maxRange.value) < parseInt(minRange.value)) {
      minRange.value = maxRange.value;
      updateMinValue();
    }
  }

  // filter box
  const filterBtn = document.querySelector('.line-bar')
  const matchFilter = document.querySelector('.filter-area-wrapper')
  if (filterBtn) {
    filterBtn.addEventListener('click', () => {
      matchFilter.parentElement.style.top = 0;
      matchFilter.parentElement.classList.add('xyz-filter')
    })
  }

  // reset filter
  const searchLocations = document.querySelector('#location')
  const genders = document.getElementsByName('gender')
  const resetFilter = document.querySelector('#reset-btn')
  if (resetFilter) {
    resetFilter.addEventListener('click', () => {
      searchLocations.value = ''
      genders.forEach(gender => {
        gender.checked = false
        selectOption.forEach(it => it.classList.remove('option-selected'))
      })
    });
  }

  // more action buttons
  let moreActionButtons = document.querySelectorAll('.more-action-btn')
  if (moreActionButtons) {
    moreActionButtons.forEach(actionBtn => {
      actionBtn.addEventListener('click', () => {
        let showAction = actionBtn.parentElement.querySelector('.button-action-area');
        showAction.style.display = 'block'
      })
    })
  }

  window.onclick = ((e) => {
    if (!e.target.closest('.filter-area-wrapper, .line-bar')) {
      if (matchFilter) {
        matchFilter.parentElement.style.top = '100%'
        matchFilter.parentElement.classList.remove('xyz-filter')
      }
    }
    moreActionButtons.forEach(actionBtn => {
      let showAction = actionBtn.parentElement.querySelector('.button-action-area');
      if (!e.target.closest('.more-action-btn, .button-action-area')) {
        showAction.style.display = 'none'
      }
    })

    if (!e.target.closest('.logout-area-wrapper, #logout')) {
      if (logoutPage) {
        logoutPage.style.display = 'none'
      }
    }
    if (!e.target.closest('.account-delete-area-wrapper, #delete-acc')) {
      if (deleteAccountPage) {
        deleteAccountPage.style.display = 'none'
      }
    }
  })

  // character limitations
  let characterLimit = document.querySelectorAll('.char-limit');
  if (characterLimit) {
    characterLimit.forEach(character => {
      let setLimit = character.getAttribute('data-set-char-limit') || 0;
      character.textContent = character.textContent.substring(0, setLimit) + '...';
    });
  }

  // chat message
  let mainChatBox = document.querySelector('.message-area');
  if (mainChatBox) {
    mainChatBox.scrollTop = mainChatBox.scrollHeight;
  }
  let linkBtn = document.querySelector('.link-btn')
  let InputMsgFile = document.querySelector('.input-msg-file')
  if (linkBtn) {
    linkBtn.addEventListener('click', () => InputMsgFile.click());
  }

  // call controller
  let micBtn = document.querySelector('.mic-btn i');
  if (micBtn) {
    micBtn.addEventListener('click', () => {
      micBtn.classList.contains('bi-mic-mute') ? (micBtn.classList.remove('bi-mic-mute'), micBtn.classList.add('bi-mic')) : (micBtn.classList.remove('bi-mic'), micBtn.classList.add('bi-mic-mute'));
    })
  }
  let volumeBtn = document.querySelector('.volume-btn i');
  if (volumeBtn) {
    volumeBtn.addEventListener('click', () => {
      volumeBtn.classList.contains('bi-volume-down') ? (volumeBtn.classList.remove('bi-volume-down'), volumeBtn.classList.add('bi-volume-up')) : (volumeBtn.classList.remove('bi-volume-up'), volumeBtn.classList.add('bi-volume-down'));
    })
  }
  let videoBtn = document.querySelector('.video-btn i');
  if (videoBtn) {
    videoBtn.addEventListener('click', () => {
      videoBtn.classList.contains('bi-camera-video') ? (videoBtn.classList.remove('bi-camera-video'), videoBtn.classList.add('bi-camera-video-off')) : (videoBtn.classList.remove('bi-camera-video-off'), videoBtn.classList.add('bi-camera-video'));
    })
  }

  // edit profile input box
  const editButtons = document.querySelectorAll(".edit-inline");
  for (const child of editButtons) {
    child.addEventListener("click", editData);
  }
  function editData(event) {
    const btn = event.target;
    const editEl = document.getElementById(btn.getAttribute("data-edit"));
    editEl.removeAttribute("readonly");
    editEl.parentElement.classList.add("form-control-focus");
    editEl.focus();
    function save() {
      editEl.setAttribute("readonly", "");
      editEl.parentElement.classList.remove("form-control-focus");
    }
    editEl.addEventListener("blur", save);
  }

  // logout btn
  let logout = document.querySelector('#logout')
  let logoutPage = document.querySelector('.logout-area');
  let cancelLogOut = document.querySelector('#cancel-logout');
  if (logout) {
    logout.addEventListener("click", () => {
      logoutPage.style.display = "block";
    })
  }
  if (cancelLogOut) {
    cancelLogOut.addEventListener("click", () => {
      logoutPage.style.display = "none";
    });
  }

  // delete account
  let deleteAccount = document.querySelector('#delete-acc')
  let deleteAccountPage = document.querySelector('.account-delete-area');
  let cancelDelete = document.querySelector('#cancel-delete');
  if (deleteAccount) {
    deleteAccount.addEventListener("click", () => {
      deleteAccountPage.style.display = "block";
    })
  }
  if (cancelDelete) {
    cancelDelete.addEventListener("click", () => {
      deleteAccountPage.style.display = "none";
    });
  }

  // prevent default form loading
  // let forms = document.querySelectorAll('form');
  // forms.forEach(form => {
  //   form.addEventListener('submit', e => {
  //     e.preventDefault();
  //   })
  // })

  // nice select
  $('.select-day').niceSelect();
  $('.select-month').niceSelect();
  $('.select-year').niceSelect();
}
