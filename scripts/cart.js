const deleteButtons = document.querySelectorAll('.delete-button');
const modal = document.getElementById('modal');
const closeModal = document.querySelector('.close-button');
const confirmDeleteButton = document.getElementById('confirm-delete');
$('#loading-screen').hide();
//  modal.style.display = 'block';
$(document).ready(function() {
            setTimeout(function() {
                $('#loading-screen').show('slow');
                $('#loading-screen').hide('slow');
            }, 500)
        }); // 2 seconds delay

deleteButtons.forEach(button => {
  button.addEventListener('click', () => {
    modal.style.display = 'block';
  });
});

closeModal.addEventListener('click', () => {
  modal.style.display = 'none';
});

confirmDeleteButton.addEventListener('click', () => {
  // Perform delete operation here
  modal.style.display = 'none';
});
 
$(document).ready(function() {
 
            $('.fa-trash').click(function() {
                
                var id = $(this).closest('tr').find('td:first-child').text();
                var title = $(this).closest('tr').find('td:nth-of-type(2)').text();

                
                if (confirm('Are you sure you want to delete ' + title + '?')) {
                    $.ajax({
                        type: 'POST',
                        url: 'config/delete_item.php',
                        data: {
                            Id:id
                        },
                        success: function(response) {
                            console.log(response);
                            alert(response); 
                            window.location.reload();

                        },
                        error: function(xhr, status, error) {
                            console.error(error);
                        }
                    });
                }
            });
            

        });