var buttonColors = ["red", "blue", "green", "yellow"];

var gamePattern = [];
var userClickedPattern = [];

var started = false;
var level = 1;

$("body").on("keydown", function() {
  if (started === false) {
    started = true;
    nextSequence();
  }
})

$(".btn").on("click", function() {
  var userChosenColor = $(this).attr("id");
  userClickedPattern.push(userChosenColor);
  playSound(userChosenColor);
  animatePress(userChosenColor);
  checkAnswer(userClickedPattern.length-1);
})

function nextSequence() {
  var randomNumber = Math.floor(Math.random() * 4);
  var randomChosenColor = buttonColors[randomNumber];
  gamePattern.push(randomChosenColor);
  $("#" + randomChosenColor).fadeOut(100).fadeIn(100).fadeOut(100).fadeIn(100);
  playSound(randomChosenColor);
  $("#level-title").text("Level " + level++);
}

function playSound(name) {
  var buttonSound = new Audio("sounds/" + name + ".mp3");
  buttonSound.play();
}

function animatePress(currentColor) {
  var buttonPress = $("#" + currentColor);
  buttonPress.addClass("pressed");
  setTimeout(function() {
    buttonPress.removeClass("pressed");
  }, 100);
}

function wrongButton() {
  $("#level-title").text("Game Over, Press Any Key to Restart");
  var gameOver = new Audio("sounds/wrong.mp3");
  gameOver.play();
  $("body").addClass("game-over");
  setTimeout(function() {
  $("body").removeClass("game-over")
  }, 100);
}

function startOver() {
  started = false; level = 1;
  gamePattern.length = 0;
  userClickedPattern.length = 0;
}

function checkAnswer(lastInput) {
  if (gamePattern[lastInput] === userClickedPattern[lastInput]) {
    if (gamePattern.length === userClickedPattern.length) {
      setTimeout(function() {
        nextSequence();
      }, 1000);
      userClickedPattern.length = 0;
      pattern = 0;
    }
  } else {
    wrongButton();
    startOver();
  }
}
