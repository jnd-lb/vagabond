

$(document).ready(function(){

    $('.completed-js').one('click',function(){
        let result = confirm('Are you sure you want to set it as completed?');
        if(!result) {return}
        let id = $(this).data('id');
        let url = 'complete-order.php'
        $.ajax({
            type: 'POST',
            url: url,
            data:{
                id: id
            },
            contentType: 'application/x-www-form-urlencoded',
            accepts: "application/json; charset=utf-8",
          
            success: function (response) {
                $(".complete-status-"+id).html('Yes');
                $(".complete-status-"+id).addClass('text-success');
                $(".complete-status-"+id).addClass('fw-bold');
                alert("Updated!");
            },
            error: function (xhr, status, error) {
                // Handle the error
                console.error('Error during checkout:', status, error);
            }
        });

    })
    console.log(    document.querySelectorAll('th'))
    document.querySelectorAll('th').forEach((header, index) => {
        header.style.cursor = 'pointer';
        header.addEventListener('click', () => {
            const table = header.closest('table');
            const tbody = table.querySelector('tbody');
            const rows = Array.from(tbody.querySelectorAll('tr'));
    
            const ascending = header.classList.toggle('asc');
            header.classList.toggle('desc', !ascending);
    
            rows.sort((a, b) => {
                const aText = a.children[index].innerText.trim();
                const bText = b.children[index].innerText.trim();
    
                const aValue = isNaN(aText) ? aText : parseFloat(aText);
                const bValue = isNaN(bText) ? bText : parseFloat(bText);
    
                return ascending
                    ? aValue > bValue ? 1 : -1
                    : aValue < bValue ? 1 : -1;
            });
    
            rows.forEach(row => tbody.appendChild(row));
        });
    });
    $('.delete-js').one('click',function(){

        let result = confirm('Are you sure you want to delete?');
        if(!result) {return}

        let id = $(this).data('id');
        let page=$(this).data('page');
        let url = 'delete.php?page='+page+'&id='+id;

        $.ajax({
            type: 'DELETE',
            url: url,
            contentType: 'application/x-www-form-urlencoded',
            accepts: "application/json; charset=utf-8",
          
            success: function (response) {
                // The server response is received, you can handle it here
              
                $('#'+page+ "-"+ id).remove()
                
                alert("Deleted!");
            },
            error: function (xhr, status, error) {
                // Handle the error
                console.error('Error during checkout:', status, error);
            }
        });
    })
    
    // Get the current URL
    var currentUrl = window.location.pathname.split('/').pop();
    
    // Loop through each nav link and compare with the current URL
    $('.nav-link').each(function () {
        
        var linkUrl = $(this).attr('href').split('/').pop();
        if (currentUrl === linkUrl) {
            $(this).addClass('bg-danger');
        }
    });
})