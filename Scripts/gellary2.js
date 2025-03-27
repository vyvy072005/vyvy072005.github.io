var numImages = 1;
var gridSize = 10;
var isAnimating = false;
var imageHeight = 720;
var imageWidth = 1000;
var squareSize = imageWidth / gridSize;
var animationDuration = 500;
var maxDelay = 100; // Максимальная случайная задержка

function leftClick() {
  if (isAnimating) return;
  numImages--;
  if (numImages < 1) numImages = 3;
  changeImages();
}

function rightClick() {
  if (isAnimating) return;
  numImages++;
  if (numImages > 3) numImages = 1;
  changeImages();
}

function changeImages() {
  if (isAnimating) return;
  isAnimating = true;

  const img = new Image();
  img.src = `/imagegallery/${numImages}.jpg`;
  img.onload = function() {
    $(".images").empty();

    for (let y = 0; y < gridSize; y++) {
      for (let x = 0; x < gridSize; x++) {
        const square = $("<div class='square'></div>");
        const delay = Math.random() * maxDelay; // Случайная задержка
        const left = x * squareSize;
        const top = y * squareSize;

        square.css({
          width: squareSize,
          height: squareSize,
          position: 'absolute',
          left: left,
          top: top,
          backgroundImage: `url(/imagegallery/${numImages}.jpg)`,
          backgroundPosition: `-${left}px -${top}px`,
          backgroundSize: `${imageWidth}px ${imageHeight}px`,
          opacity: 0,
          transform: `scale(0.8)`, // Начальное масштабирование
          transition: `opacity ${animationDuration}ms ease-in-out, transform ${animationDuration}ms ease-in-out` // Анимация масштабирования
        });

        square.appendTo(".images");

        setTimeout(() => {
          square.css({ opacity: 1, transform: `scale(1)` }); 
          square.addClass('color-change');
          setTimeout(() => square.removeClass('color-change'), 100); // Убираем класс 
        }, delay);
      }
    }

    setTimeout(() => { isAnimating = false; }, animationDuration + maxDelay);
  }
}

$(document).ready(function() {
  
});
