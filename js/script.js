// Adding a random number function

document.getElementById("demo").innerHTML = "My First JavaScript";


function myFunction(p1, p2) {
    return p1 * p2;   // The function returns the product of p1 and p2
  }

// AJAX call

  $(document).ready(function() {

    $("#type").change(function() {
        var val = $(this).val();

        $.post('query.php', {'brand' : val}, function(data){
            var jsonData = JSON.parse(data); // turn the data string into JSON
            var newHtml = ""; // Initialize the var outside of the .each function
            $.each(jsonData, function(item) {
                newHtml += "<option>" + item['model'] + "</option>";
            })
            $("#size").html(newHtml);
        });
    });
});
