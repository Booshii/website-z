
  /************* DOM-Elements ************** */
  const selectMonth = document.getElementById('select-month');
  const selectYear = document.getElementById('select-year');
  const prevBtn = document.getElementById('prev-month');
  const nextBtn = document.getElementById('next-month');
  const selectFlat = document.getElementById('select-flat');
  const selects = document.querySelectorAll('select[id^="select-status_"]');

/***************************************** */
/************** Functions **************** */
/***************************************** */
  /************ Helper ************** */
  function getYearMonth(){
    const month = Number(selectMonth.value);
    const year = Number(selectYear.value);
    return { month, year }
  }
  function redirectTo(month, year, flat) {
    window.location.href = `/dashboard?month=${month}&year=${year}&flat=${flat}`;
  }

/***************************************** */
/************ EventListener ************** */
/***************************************** */
  /********** flat-dropdown ********** */
  selectFlat.addEventListener('change', () => {
    let { month, year } = getYearMonth()
    const flat = parseInt(selectFlat.value); 
    redirectTo(month, year, flat);
  });
  /********** form-dropdown ********** */
  selects.forEach(select => {
      select.addEventListener('change', () => {
        const id = select.id.split('_').pop(); // splittet vor und nach _
        const label  = document.getElementById('status-label' + id); 
        if (!label) return; 
        label.classList.toggle('label-occupied', select.value !== 'true');
        label.classList.toggle('label-spare',    select.value === 'true');
      });
  });

  /************ Calendar ************** */
  prevBtn.addEventListener('click', () => {
    let { month, year } = getYearMonth()
    month--;
    if (month < 1) {
      month = 12;
      year--;
    }
    const flat = parseInt(selectFlat.value); 
    redirectTo(month, year, flat);
  });

  nextBtn.addEventListener('click', () => {
    let { month, year } = getYearMonth()
    month++;
    if (month > 12){
      month = 1;
      year++;
    }

    const flat = parseInt(selectFlat.value); 
    redirectTo(month, year, flat);
  });

  selectMonth.addEventListener('change', () => {
    let { month, year } = getYearMonth()
    const flat = parseInt(selectFlat.value); 
    redirectTo(month, year,flat);
  });

  selectYear.addEventListener('change', () => {
    let { month, year } = getYearMonth()
    const flat = parseInt(selectFlat.value); 
    redirectTo(month, year, flat);
  });
