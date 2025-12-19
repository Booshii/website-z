/***************************************** */
/************* DOM-Elements ************** */
/***************************************** */

  /************ Gallery ************** */
  const galleryModalElement = document.getElementById('gallery-modal-element');
  const galleryMoreButton = document.getElementById('gallery-more-button');
  const galleryItems = document.querySelectorAll('.gallery-item');
  const galleryModalCounter = document.getElementById('counter');
  const galleryModalImage = document.getElementById('gallery-modal-image');
  const galleryModalNextButton = document.getElementById('gallery-modal-next-button');
  const galleryModalPrevButton = document.getElementById('gallery-modal-prev-button');
  const galleryModalCloseButton = document.getElementById('gallery-modal-close-button');
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
  const flat = document.querySelector('meta[name="page-id"]').getAttribute('content'); 
  const baseUrl = new URL("http://localhost/api/events");
  let currentShownModalImageIndex; // wofür???
  let currentIndex;
  let lightboxImagesCache = null;
  //   { full: "pics/apt01/apt01-bedroom-01.avif", alt: "Schlafzimmer-1"},
  //   { full: "pics/apt01/apt01-hall-01.avif", alt: "Flur"},
  //   { full: "pics/apt01/apt01-kitchen-01.avif", alt: "Küche"},
  //   { full: "pics/apt01/apt01-livingroom-01.avif", alt: "Wohnzimmer-1"},
  //   { full: "pics/apt01/apt01-livingroom-02.avif", alt: "Wohnzimmer-2"},
  //   { full: "pics/apt01/apt01-bath-01.avif", alt: "Bad"},
  //   { full: "pics/apt01/apt01-outside-01.avif", alt: "Draußen-1"},
  //   { full: "pics/apt01/apt01-upstairs-02.avif", alt: "Oben-2"},
  //   { full: "pics/apt01/apt01-upstairs-03.avif", alt: "Oben-3"},
  //   { full: "pics/apt01/apt01-upstairs-01.avif", alt: "Oben-1"},
  //   { full: "pics/apt01/apt01-outside-03.avif", alt: "Draußen-3"},
  //   { full: "pics/apt01/apt01-outside-02.avif", alt: "Draußen-2"},
  // ]

/***************************************** */
/************ EventListener ************** */
/***************************************** */
  /************ Gallery ************** */
  galleryItems.forEach((item, index) => {
    item.addEventListener('click', () => openModal(galleryModalElement, index)); 
  });
  galleryMoreButton.addEventListener('click', () => openModal(galleryModalElement, 7));
  galleryModalCloseButton.addEventListener('click', () => closeModal(galleryModalElement));
  /********** Gallery - Modal ************ */
  galleryModalPrevButton.addEventListener('click', showPrevImage);
  galleryModalNextButton.addEventListener('click', showNextImage);
  /********* Equipment - Modal *********** */
  equipmentCloseButton.addEventListener('click', () => closeModal(equipmentModalElement));
  equipmentModalButton.addEventListener('click', () => openModal(equipmentModalElement));

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
  function getLightboxImages() {
    if (lightboxImagesCache) {
      return lightboxImagesCache;
    }
    const lightboxImagesJsonElement = document.getElementById("image-json");
    if (!lightboxImagesJsonElement) {
      throw new Error('image-json not found');
    }
    const lightboxImagesJson = JSON.parse(lightboxImagesJsonElement.textContent)
    lightboxImagesCache = lightboxImagesJson.lightboxImages;
    return lightboxImagesCache;
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
  function openModal(modalElement, index = null) {
    if (index !== null) {
      currentIndex = index;
      loadImage(currentIndex);
    }
    modalElement.showModal();
  }

  function closeModal(modalElement){
    currentImageId = -1;
    galleryModalImage.removeAttribute("src");
    galleryModalImage.removeAttribute("alt");
    modalElement.close();
  }

  function loadImage(id){
    const lightboxImages = getLightboxImages();
    const srcFullImage = lightboxImages[id].full;
    const img = new Image(); 
    img.onload = () => {
      galleryModalImage.src = srcFullImage; 
      galleryModalImage.alt = lightboxImages[id].alt || '';
    };
    img.onerror = () => {
      console.error("Bild konnte nicht geladen werden:", srcFullImage);
    };
    img.src = srcFullImage;
    updateCounter();
  }

  function updateCounter(){
    const lightboxImages = getLightboxImages();
    let total = lightboxImages.length; 
    galleryModalCounter.textContent = `${currentIndex + 1} / ${total}`;
    galleryModalElement.setAttribute('aria-label', `Bild ${currentIndex + 1} von ${total}`);
  }

  function showNextImage(){
    const lightboxImages = getLightboxImages();
    currentIndex = (currentIndex < lightboxImages.length - 1) ? currentIndex + 1 : 0; 
    loadImage(currentIndex);
  }

  function showPrevImage(){
    const lightboxImages = getLightboxImages();
    currentIndex = (currentIndex > 0) ? currentIndex - 1 : lightboxImages.length - 1;
    loadImage(currentIndex);
  }

