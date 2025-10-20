/***************************************** */
/************* DOM-Elements ************** */
/***************************************** */

  /************ Gallery ************** */
  const galleryModalElement = document.getElementById('gallery-modal-element');
  const galleryMoreButton = document.getElementById('gallery-more-button');
  const galleryItems = document.querySelectorAll('.gallery-item');
  const galleryModalCounter = document.getElementById('counter');
  const galleryModalImage = document.getElementById('gallery-modal-image');
  /************ Equipment ************** */
  const equipmentModalElement = document.getElementById('equipment-modal-element');
  const equipmentModalButton = document.getElementById('equipment-more-btn');
  const equipmentCloseButton = document.getElementById('equipment-modal-close-button');
  /************ Calendar ************** */
  const selectMonth = document.getElementById('select-month');
  const selectYear = document.getElementById('select-year');
  const prevBtn = document.getElementById('prev-month');
  const nextBtn = document.getElementById('next-month');
  const calendarContainer = document.getElementById('calendar-container');

  /************* Variables ************** */
  const baseUrl = new URL("http://localhost/api/events");
  const flat = 2; 
  let currentShownModalImageIndex; 

/***************************************** */
/************ EventListener ************** */
/***************************************** */

  /************ Gallery ************** */
  showMoreButton.addEventListener('click', () => {
    openModal();
  })

  /************ Calendar ************** */
  selectMonth.addEventListener('change', () => {
    let { month, year } = getYearMonth()
    updateCalendar(month, year,flat);
  });
  selectYear.addEventListener('change', () => {
    let { month, year } = getYearMonth()
    updateCalendar(month, year, flat);
  });
  
  prevBtn.addEventListener('click', () => {
    let { month, year } = getYearMonth()
    month --;
    if (month < 1) {
      month = 12;
      year--;
    }
    selectMonth.value = String(month);
    selectYear.value = String(year); 
    updateCalendar(month, year, flat); 
  });
  
  nextBtn.addEventListener('click', () => {
    let { month, year } = getYearMonth()
    month ++;
    if (month > 12) {
      month = 1;
      year++;
    }
    selectMonth.value = String(month);
    selectYear.value = String(year); 
    updateCalendar(month, year, flat); 
  });

  /************ Equipment ************** */
  equipmentCloseButton.addEventListener('click', () => {
    modalElement.close();
  })
  equipmentModalButton.addEventListener('click', () => {
    openModal();
  })



// hier müssen mit arrow functions noch eingefügt werden 
// variable anpassen und updateCalendar ausführen 

/***************************************** */
/************** Functions **************** */
/***************************************** */
  /************ Helper ************** */
  function getYearMonth(){
    const month = Number(selectMonth.value);
    const year = Number(selectYear.value);
    return { month, year }
  }
  /************ Calendar ************** */
  async function updateCalendar(month, year, flat) {
    month = parseInt(month, 10);
    year  = parseInt(year, 10);
    flat  = parseInt(flat, 10);

    if (!Number.isInteger(year) || !Number.isInteger(month) || !Number.isInteger(flat)) {
      console.error("year, month, flat müssen ganze Zahlen sein.");
      return;
    }
     if (month < 1 || month > 12) {
      console.error("month muss zwischen 1 und 12 liegen.");
      return;
    }
    if(!calendarContainer ){
      console.error('.calendar-container nicht gefunden');
      return;
    }
    try {
      const newUrl = new URL(baseUrl);
      newUrl.searchParams.set("year", year);
      newUrl.searchParams.set("month", month);
      newUrl.searchParams.set("flat", flat);

      const res = await fetch(newUrl, { method: "GET", headers: { "Accept": "text/html" } });

      if (!res.ok) throw new Error(`HTTP ${res.status}`);
      const html = (await res.text()).trim();

      const tpl = document.createElement('template');
      tpl.innerHTML = html

      calendarContainer.replaceChildren(...tpl.content.childNodes);

    } catch (err) {
      console.error('Kalender-Update fehlgeschlagen:', err);
      calendarContainer.innerHTML = '<p class="error">Fehler beim Laden des Kalenders.</p>';
    }
  }
  /************ Modals ************** */
  function openModal(modalElement){
    modalElement.showModal();
    // document.body.classList.add('modal-open'); // deactivate scrollilng on page
  }

  function openGalleryModal(index){
    loadImage(index);
    galleryModalElement.showModal();
  }

  function loadImage(id){
    const srcFullImage = galleryItems[id].dataset.full || galleryItems[id].src;
    const img = new Image(); 
    img.onload = () => {
        galleryModalImage.src = srcFullImage; 
        galleryModalImage.alt = galleryItems[id].alt || '';
    }
    img.src = srcFullImage;
    updateCounter();
  }

  function updateCounter(){
    let total = galleryItems.length; 
    galleryModalCounter.textContent = `${currentIndex + 1} / ${total}`;
    galleryModalElement.setAttribute('aria-label', `Bild ${currentIndex + 1} von ${total}`);
  }

