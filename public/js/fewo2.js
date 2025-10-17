
  /************* DOM-Elements ************** */
  const selectMonth = document.getElementById('select-month');
  const selectYear = document.getElementById('select-year');
  const prevBtn = document.getElementById('prev-month');
  const nextBtn = document.getElementById('next-month');
  const calendarContainer = document.getElementById('calendar-container');
   /************* rle,emts for modal ************** */
  const modalContainer = document.getElementById('modal-container');
  const modalElement = document.getElementById('modal-element')
  const modalButton = document.getElementById('equipment-more-btn')
  const closeButton = document.getElementById('modal-close-button');

  /************* consts ************** */
  const baseUrl = new URL("http://localhost/api/events");
  const flat = 2; 
  let month = selectMonth.value;
  let year = selectYear.value;

  /************ EventListener ************** */
  selectMonth.addEventListener('change', () => {
    month = selectMonth.value;
    updateCalendar(month, year,flat);
  });
  selectYear.addEventListener('change', () => {
    year = selectYear.value;
    updateCalendar(month, year, flat);
  });
  
  prevBtn.addEventListener('click', () => {
    month --;
    if (month < 1) {
      month = 12;
      year--;
    }
    selectMonth.value = month;
    selectYear.value = year; 
    updateCalendar(month, year, flat); 
  });
  
  nextBtn.addEventListener('click', () => {
    month ++;
    if (month > 12) {
      month = 1;
      year++;
    }
    selectMonth.value = month;
    selectYear.value = year; 
    updateCalendar(month, year, flat); 
  });

  closeButton.addEventListener('click', () => {
    modalElement.close();
  })
  modalButton.addEventListener('click', () => {
    openModal();

  })
// hier müssen mit arrow functions noch eingefügt werden 
// variable anpassen und updateCalendar ausführen 
  /*************** Functions *************** */

  // redirect
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
/***********************************/
/********** Modal Fenster **********/
/***********************************/
function openModal(){
    modalElement.showModal();
    // document.body.classList.add('modal-open'); // deactivate scrollilng on page
}

