//validate form function for if the input is greater than 5
      function validate(form) {
        NumberBoxes = document.querySelectorAll('input[type=number]');
        
          for (box of NumberBoxes){
            if(box.valueAsNumber >= 5) {
              if (!confirm('You picked '+box.valueAsNumber+' items for '+box.name+', are you sure?')){ return false;} 
            } 
          }
      }
      