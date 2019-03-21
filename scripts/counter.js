var clicks = 1;

document.getElementById("clicks").innerHTML = clicks;

$('.add-counter').click(function() {
  clicks += 1;
  document.getElementById("clicks").innerHTML = clicks;
  $('.add-counter').addClass("added");
});
$('.substract-counter').click(function() {
    if(clicks > 1)
    {
  clicks -= 1;
  document.getElementById("clicks").innerHTML = clicks;
  $('.substract-counter').addClass("added");
    }
});