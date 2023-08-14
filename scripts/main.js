const deleteButtons = document.querySelectorAll('.delete-button');
const modal = document.getElementById('modal');
const closeModal = document.querySelector('.close-button');
const confirmDeleteButton = document.getElementById('confirm-delete');
$('#loading-screen').hide();
$('.fa-shopping-cart').click(function() {
                
                var id = $(this).closest('tr').find('td:first-child').text();
                var title = $(this).closest('tr').find('td:nth-of-type(2)').text();

                
                if (confirm('Do you want to add ' + title + ' to cart ?')) {
                    $.ajax({
                        type: 'POST',
                        url: 'config/add-cart.php',
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
 
$(document).ready(function() {
 
 

            setTimeout(function() {
                $('#loading-screen').show('slow');
                $('#loading-screen').hide('slow');
            }, 500)
        }); // 2 seconds delay

        const emoji = $('.emoji');
        console.log(emoji)
         function changePositionAndRotate() {
            // Generate new position and rotation values
            const newX = Math.random() * ($(window).width() - emoji.width());
            const newY = Math.random() * ($(window).height() - emoji.height());
            const newRotation = Math.random() * 360;
        
             emoji.css({
                left: newX + 'px',
                top: newY + 'px',
                transform: 'rotate(' + newRotation*2 + 'deg)'+'translate('+'30px'+')'
            });
        }
        changePositionAndRotate()
        console.log($('.search-input'))
        $('.search-icon').on("click", function() {
            var searchTerm = $('.search-input').val(); // Get the search term from the input
            $.ajax({
                type: 'GET',
                url: 'config/find-item.php',
                data: {
                    searchTerm: searchTerm // Use the correct variable name here
                },
                success: function(response) {
                    alert(response);
                },
                error: function(xhr, status, error) {
                    console.error(error);
                }
            });
        });
        
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
 

 