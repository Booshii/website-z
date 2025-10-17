
  /************* DOM-Elements ************** */
  const select = document.getElementById('select-month-year');
  const prevBtn = document.getElementById('prev-month');
  const nextBtn = document.getElementById('next-month');
  const selectFlat = document.getElementById('select-flat');


  /*************** Functions *************** */

  // redirect
  function redirectTo(month, year, flat) {
    window.location.href = `/dashboard?month=${month}&year=${year}&flat=${flat}`;
  }

  /************ EventListener ************** */
  prevBtn.addEventListener('click', () => {
    let [ month, year ] = select.value.split('-').map(Number);
    month--;
    if (month < 1) {
      month = 12;
      year--;
    }
    const flat = parseInt(selectFlat.value); 
    redirectTo(month, year, flat);
  });

  nextBtn.addEventListener('click', () => {
    let [ month, year ] = select.value.split('-').map(Number);
    month++;
    if (month > 12){
      month = 1;
      year++;
    }

    const flat = parseInt(selectFlat.value); 
    redirectTo(month, year, flat);
  });

  select.addEventListener('change', () => {
    const [ month, year ] = select.value.split('-').map(Number);
    const flat = parseInt(selectFlat.value); 
    redirectTo(month, year, flat);
  });

  selectFlat.addEventListener('change', () => {
    const [ month, year ] = select.value.split('-').map(Number);
    const flat = parseInt(selectFlat.value); 
    redirectTo(month, year, flat);
  });

  // beim Laden alle Selects durchgehen 

  var selects = document.querySelectorAll('select[id^="select-status_"]');

  selects.forEach(select => {
      // Event bei Änderungen 
      select.addEventListener('change', () => {
          const id = select.id.split('_').pop(); // splittet vor und nach _
          // holt das zu der id zugehörige label
          const label  = document.getElementById('status-label' + id); 

          if (!label) return; 

          label.classList.toggle('label-occupied', select.value !== 'true');
          label.classList.toggle('label-spare',    select.value === 'true');
      });
  });
