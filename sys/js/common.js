const mailPattern = /^([a-z0-9_-]+\.)*[a-z0-9_-]+@[a-z0-9_-]+(\.[a-z0-9_-]+)*\.[a-z]{2,6}$/;

let cls = {
  error: '--error',
}

function preventDefault(e) {
  e.preventDefault();
}

let html = document.querySelector('html');
let body = document.querySelector('body');
let inner = document.querySelector('.inner');
let airLocale = document.body.classList.contains('lang-t2') ? { days: ['Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday'],
  daysShort: ['Sun', 'Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat'],
  daysMin: ['Su', 'Mo', 'Tu', 'We', 'Th', 'Fr', 'Sa'],
  months: ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'],
  monthsShort: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
  today: 'Today',
  clear: 'Clear',
} : {
  days: ['Воскресенье', 'Понедельник', 'Вторник', 'Среда', 'Четверг', 'Пятница', 'Суббота'],
  daysShort: ['Вос', 'Пон', 'Вто', 'Сре', 'Чет', 'Пят', 'Суб'],
  daysMin: ['Вс', 'Пн', 'Вт', 'Ср', 'Чт', 'Пт', 'Сб'],
  months: ['Январь', 'Февраль', 'Март', 'Апрель', 'Май', 'Июнь', 'Июль', 'Август', 'Сентябрь', 'Октябрь', 'Ноябрь', 'Декабрь'],
  monthsShort: ['Янв', 'Фев', 'Мар', 'Апр', 'Май', 'Июн', 'Июл', 'Авг', 'Сен', 'Окт', 'Ноя', 'Дек'],
  today: 'Сегодня',
  clear: 'Очистить',
  dateFormat: 'dd.MM.yyyy',
  timeFormat: 'HH:mm',
  firstDay: 1
};


// FANCYBOX SETUP
Fancybox.bind("[data-fancybox]", {
  dragToClose: false,
  autoFocus: false,
});

// MAIN DOCUMENT
document.addEventListener('DOMContentLoaded', () => {

  // ANIMATION
  var anBlocks = document.querySelectorAll('.an');
  if (anBlocks) {
    anBlocks.forEach((block) => {
      if (block.classList.contains('parallax')) {
        block.inner = document.createElement('div');
        block.inner.innerHTML = block.innerHTML;
        block.innerHTML = '';
        block.append(block.inner);
      }
    })
  }
  function animatedBlocks() {
    var Y = window.scrollY;
    let visibleHeight = window.innerHeight - 100;
    anBlocks.forEach((block) => {

      if (!block.classList.contains('--loaded')) {
        let timeout = block.getAttribute('data-timeout');
        if (timeout) {
          block.style.transitionDelay = timeout;
        }
        if (block.getBoundingClientRect().top < visibleHeight) {
          block.classList.add('--loaded');
        }
      }

      if (block.classList.contains('parallax')) {
        let percentVal = (block.getBoundingClientRect().y + (window.innerHeight / 2)) / 10
        if (percentVal > 200 || percentVal < -200) {
          return false;
        }
        block.inner.style.transform = 'translateY(' + (percentVal) + 'px)';
      }
    });
  }

  setTimeout(() => {
    animatedBlocks();
    document.addEventListener('scroll', () => {
      animatedBlocks();
    });
  }, 500);


  // MENU HAM
  let btnHam = document.querySelector('.ham');
  let nav = document.querySelector('.header__nav');

  btnHam.addEventListener('click', () => {
    btnHam.classList.toggle('--toggle');
    nav.classList.toggle('--show');

    html.classList.toggle('overflow-disable');
    body.classList.toggle('overflow-disable');
    inner.classList.toggle('overflow-disable');
  });

  // MENU SEARCH
  let btnSearch = document.querySelector('.search');
  let wrapSearch = document.querySelector('.search__wrap');
  let closeSearch = document.querySelector('.search__close');

  btnSearch.addEventListener('click', () => {
    wrapSearch.classList.add('--show');
  });

  document.addEventListener('click', (event) => {
    if (!event.target.closest('.search') || event.target == closeSearch) {
      wrapSearch.classList.remove('--show');
    }
  });

  // LANGUAGE SELECTOR
  let lang = document.querySelector('.lang')

  lang.addEventListener('click', () => {
    lang.classList.toggle('--show')
  })

  document.addEventListener('click', (event) => {
    if (!event.target.closest('.lang')) {
      lang.classList.remove('--show');
    }
  });

  // AUTO NUMBER FOR OL LIST
  let autoNumberList = document.querySelectorAll('.rules__elem-list ol');

  if (autoNumberList) {
    autoNumberList.forEach((ol) => {
      let list = ol.querySelectorAll('li');

      list.forEach((li, i) => {
        let span = document.createElement('span');

        span.className = 'li-counter';
        span.textContent = i + 1;
        li.prepend(span);

      })
    });
  }

  // DATEPICKER
  let date = new Date();
    
    
  let datepickers = document.querySelectorAll('.news__datepicker.datepicker');
  if (datepickers) {
      datepickers.forEach((datepicker)=>{
      
          let dpMin, dpMax;
          let dpMinInput = datepicker.querySelector('.datepicker__input.--start input'),
              dpMaxInput = datepicker.querySelector('.datepicker__input.--end input');
          let url = new URL(window.location.href);
          let date_start = url.searchParams.get('date_start'),
              date_end   = url.searchParams.get('date_end');
              
            
          if (dpMinInput) {
            date_start = url.searchParams.get(dpMinInput.name);
            if (date_start) {
                date_start = date_start.split('.');
                date_start = new Date(date_start[2], date_start[1] - 1, date_start[0]);
                dpMinInput.value = date_start;
            }
            dpMin = new AirDatepicker(dpMinInput, {
                startDate: date_start ? Date.parse(date_start) : new Date().setFullYear(new Date().getFullYear() - 1),
                selectedDates: date_start ? Date.parse(date_start) : [new Date().setFullYear(new Date().getFullYear() - 1)],
                maxDate: date,
		locale: airLocale,
                onSelect({ date }) {
                  if (dpMaxInput) {
                      dpMax.update({
                        minDate: dpMaxInput ? date : null
                      })
                  }
                }
              })
          }
            
          if (dpMaxInput) {
            date_end = url.searchParams.get(dpMaxInput.name);
            if (date_end) {
                date_end = date_end.split('.');
                date_end = new Date(date_end[2], date_end[1] - 1, date_end[0]);
            }
            dpMax = new AirDatepicker(dpMaxInput, {
                startDate: date_end ? Date.parse(date_end) : new Date(),
                selectedDates: date_end ? Date.parse(date_end) : [new Date()],
                maxDate: date,
                position: 'bottom right',
		locale: airLocale,
                onSelect({ date }) {
                  if (dpMinInput) {
                      dpMin.update({
                        maxDate: dpMinInput ? date : null,
                      })
                  }
                }
             });
          }
      })
  }

  // OFFICES
  let offices = document.querySelectorAll('.offices__item');
  if (offices) {
    let officesCurrent = null;
    offices.forEach((office) => {
      if (office.classList.contains('--current')) {
        officesCurrent = office;
      }

      office.addEventListener('click', () => {
        officesCurrent.classList.remove('--current');

        officesCurrent = office;
        officesCurrent.classList.add('--current');
      });

    });
  }

  // PRICE MAP
  let priceAreas = document.querySelectorAll('.price__area');
  let priceInner = document.querySelector('.price__inner');

  if (priceAreas && priceInner) {
    let priceCurrentArea = null;

    priceAreas.forEach((area) => {
      if (area.classList.contains('--current')) {
        setCurrentPrice(area);
      }

      area.addEventListener('click', () => {
        setCurrentPrice(area);
      })
    })


    function setCurrentPrice(area) {
      if (priceCurrentArea) {
        priceCurrentArea.classList.remove('--current');
      }

      priceCurrentArea = area;

      priceCurrentArea.classList.add('--current');
      priceInner.classList.add('--show');
      priceInner.innerHTML = area.innerHTML;

    }
  }

  // MAP
  let $map = document.querySelector('#map');

  if ($map && ymaps) {
    ymaps.ready(mapInit);

    function mapInit() {
      let mapPosition, mapPlaceholder;

      mapPosition = $map.getAttribute('data-map');
      mapPosition = mapPosition.split(',');

      for (let i = 0; i < mapPosition.length; i++) {
        mapPosition[i] = Number(mapPosition[i]);
      }

      mapPlaceholder = $map.getAttribute('data-map');
      mapPlaceholder = mapPlaceholder.split(',');

      let ymap = new ymaps.Map($map, {
        center: [mapPosition[0], mapPosition[1]],
        zoom: 14,
        // controls: []
      });

      let placemark = new ymaps.Placemark(mapPlaceholder, {
      }, {
        iconLayout: 'default#image',
        iconImageHref: '/upload/icons/placemark.svg',
        iconImageSize: [48, 58],
        iconImageOffset: [-20, -60],
      }, {});

      ymap.geoObjects.add(placemark);

      ymap.behaviors.disable('scrollZoom');

      function setMapPostion() {
        let dw = window.innerWidth;

        if (dw > 1220) {
          ymap.setCenter([mapPosition[0] - -0.001, mapPosition[1] - 0.00001]);
        } else if (dw <= 1220 && dw > 767) {
          ymap.setCenter([mapPosition[0], mapPosition[1] - 0.01]);
        } else {
          ymap.setCenter(mapPosition);
        }
      }

      setMapPostion();
      window.addEventListener('resize', () => {
        setMapPostion();
      });
    }
  }

  // VALIDATOR
  let inputs = document.querySelectorAll('.input');

  inputs.forEach((input) => {
    input.area = input.querySelector('.input__area');
    input.addEventListener('focusin', () => {
      input.classList.add('--focus');
      input.classList.remove(cls.error);
    })
    input.addEventListener('focusout', () => {
      input.classList.remove('--focus');
    })

    if (input.classList.contains('--name')) {
      input.area.addEventListener('input', () => {
        input.area.value = input.area.value.replace(/[^\D]/g, '');
      });


    } else if (input.classList.contains('--tel')) {
      IMask(input.area, {
        mask: '+{7} (000) 000-00-00',
      });
      input.area.addEventListener('input', () => {
      })

    } else if (input.classList.contains('--email')) {
      input.area.addEventListener('input', () => {
      });

    } else {
      input.area.addEventListener('input', () => {
      });
    }
  });

  let textareas = document.querySelectorAll('.textarea');
  if (textareas) {
    textareas.forEach((textarea) => {
      textarea.area = textarea.querySelector('.textarea__area');
      textarea.area.addEventListener('focusin', () => {
        textarea.classList.add('--focus');
        textarea.classList.remove(cls.error);
      })
      textarea.addEventListener('focusout', () => {
        textarea.classList.remove('--focus');
      })
    })
  }

  let validateForms = document.querySelectorAll('.form');

  if (validateForms) {
    validateForms.forEach((form) => {
      let btnSubmit = form.querySelector('button');
      let inputsRequired = form.querySelectorAll('.input.--required');
      let textareasRequired = form.querySelectorAll('.textarea.--required');
      let checksRequired = form.querySelectorAll('.check.--required')
      let popupModalForm = form.querySelector('.popup__form');
      let popupSendOkAttr = form.getAttribute('data-message-ok');

      btnSubmit.addEventListener('click', (event) => {
        let errors = 0;

        if (inputsRequired.length > 0) {
          inputsRequired.forEach((input) => {
            let value = input.area.value;

            if (input.classList.contains('--name')) {
              if (value.length < 2) {
                errors++;
                input.classList.add(cls.error);
              } else {
                input.classList.remove(cls.error);
              }
            }

            if (input.classList.contains('--email')) {
              if (!mailPattern.test(value)) {
                errors++;
                input.classList.add(cls.error);
              } else {
                input.classList.remove(cls.error);
              }
            }

            if (input.classList.contains('--tel')) {
              if (value.length < 18) {
                errors++;
                input.classList.add(cls.error);
              } else {
                input.classList.remove(cls.error);
              }
            }

          })
        }

        if (textareasRequired.length > 0) {
          textareasRequired.forEach((textarea) => {
            let value = textarea.area.value;

            if (textarea.classList.contains('--comment')) {
              if (value.length < 5) {
                errors++;
                textarea.classList.add(cls.error);
              } else {
                textarea.classList.remove(cls.error);
              }
            }

          })
        }
        

        if (errors == 0) {
          event.preventDefault(); // <- remove on ajax writing
                
                
          let formData = new FormData(form);
          let xhr = new XMLHttpRequest();
          xhr.open('POST', '/order.php');
          xhr.send(formData);
          
          xhr.onload = function() {
              if (xhr.status == 200) { // анализируем HTTP-статус ответа, если статус не 200, то произошла ошибка
                Fancybox.close();
                Fancybox.show(
                    [
                      {
                        src: "#popup-thanks",
                      },
                    ],
                );
             }
          };

          
        } else {
          event.preventDefault();
        }
      })
    })
  }
  
  
  let printBtns = document.querySelectorAll('.print-btn');
  if (printBtns) {
      printBtns.forEach((btn)=>{
        btn.addEventListener('click', ()=>{
            window.print(); 
        })
       
      });
  }
  
  let shareBtns = document.querySelectorAll('.share-btn');
  if (shareBtns) {
      shareBtns.forEach((btn)=>{
        btn.addEventListener('click', ()=>{
            btn.classList.toggle('--show');
        })
       
      });
  }
  
  
  if (document.querySelector('.result')) {
      let result = {
          price: {
                form:  document.getElementById('auc-price-form'),
                input:  document.getElementById('auc-price-input'),
                button: document.getElementById('auc-price-button'),
		list: document.getElementById('auc-price-list')
          },
          volume: {
                form:  document.getElementById('auc-volume-form'),
                inputFrom:  document.getElementById('auc-volume-input-from'),
                inputTo:  document.getElementById('auc-volume-input-to'),
                button: document.getElementById('auc-volume-button'),
		zdBlock: document.getElementById('auc-volume-zd-block'),
		autoBlock: document.getElementById('auc-volume-auto-block')
          },
	  sep: document.body.classList.contains('lang-t2') ? '-en' : ''
      };
      
      result.price.input.dp = new AirDatepicker(result.price.input, {
        maxDate: new Date(),
	locale: airLocale,
      })
      
      result.price.button.addEventListener('click', (event)=>{
		event.preventDefault();
		if (!result.price.input.value) {
			return false;
		}
	    var post = {};

	    post['year'] = result.price.input.value;
	    post['mode'] = 'y';


	    BX.ajax({
		method: "POST",
		url: "/local/templates/trading/components/bitrix/news.list/auctions-price" + result.sep  + "/ajax.php",
		data: post,
		async: true,
		dataType: 'html',
		timeout: 30,
		processData: true,
		start: true,
		cache: false,
		onsuccess: function(data){
			BX.showWait();

			let el = document.createElement('div');
			el.innerHTML = data;
			el.list = el.querySelector('.result__elem-list');
			result.price.list.innerHTML = el.list.innerHTML;

			BX.closeWait();
		},
	    })

	    return false;
      });




      result.volume.inputFrom.dp = new AirDatepicker(result.volume.inputFrom, {
        maxDate: new Date(),
	locale: airLocale,
        onSelect({ date }) {
          if (result.volume.inputTo) {
              result.volume.inputTo.dp.update({
                // maxDate: date,
              })
          }
        }
      })
      
      result.volume.inputTo.dp = new AirDatepicker(result.volume.inputTo, {
        maxDate: new Date(),
        position: 'bottom right',
	locale: airLocale,
        onSelect({ date }) {
          if (result.volume.inputFrom) {
              if (result.volume.inputFrom.dp.viewDate > date) {
                  result.volume.inputFrom.dp.selectDate(date);
              }
              result.volume.inputFrom.dp.update({
                maxDate: date,
              })
          }
        }
     });
      



      result.volume.button.addEventListener('click', (event)=>{
		event.preventDefault();
		if (!result.volume.inputFrom.value && !result.volume.inputTo.value) {
			return false;
		}
		var post = {};

	    post['from'] = result.volume.inputFrom.value;
	    post['to'] = result.volume.inputTo.value;


	    BX.ajax({
		method: "POST",
		url: "/local/templates/trading/components/bitrix/news.list/auctions-volume" + result.sep  + "/ajax.php",
		data: post,
		async: true,
		dataType: 'html',
		timeout: 30,
		processData: true,
		start: true,
		cache: false,
		onsuccess: function(data){
			BX.showWait();

			let el = document.createElement('div');
			el.innerHTML = data;
			el.zd = el.querySelector('#auc-volume-zd-block');
			el.auto = el.querySelector('#auc-volume-auto-block');
			result.volume.zdBlock.innerHTML = el.zd.innerHTML;
			result.volume.autoBlock.innerHTML = el.auto.innerHTML;

			BX.closeWait();
		},
	    })

	    return false;
      });
      
      
  }


})