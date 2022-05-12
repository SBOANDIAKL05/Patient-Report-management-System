// For all able searches-------------------------------------------------------------------

const searchFunction = () =>
{
    let filter = document.getElementById("search").value.toUpperCase();
    let myTable = document.getElementById("myTable");
    let tr = myTable.getElementsByTagName('tr');

    for(var i = 0; i < tr.length; i++){
      let td = tr[i].getElementsByTagName('td')[1];

      if(td){
        let textvalue = td.textContent || td.innerHTML;

        if(textvalue.toUpperCase().indexOf(filter) > -1){
          tr[i].style.display = "";
        }
        else{
          tr[i].style.display = "none";
        }

      }
    }
}

//user.php------------------------------------------------------------------

//User FIlter--------------------------------------------------------
const filtr = (asd) =>
{
    let filter = asd;
    let myTable = document.getElementById("myTable");
    let tr = myTable.getElementsByTagName('tr');

    for(var i = 0; i < tr.length; i++){
      if(asd == "All"){
          tr[i].style.display = "table-row";

        }
        else
        {
          let td = tr[i].getElementsByTagName('td')[5];

          if(td){
            let textvalue = td.textContent || td.innerHTML;
        
          if(textvalue.indexOf(filter) > -1)
          {
              tr[i].style.display = "";
          }
          else
          {
              tr[i].style.display = "none";
          }
      }
      }
    }
}

//delete function----------------------