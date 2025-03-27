var numImages = 1;
var gridSize = 10;
var isAnimating = false;
var imageHeight = 500;
var imageWidth = 800;
var squareSize = imageWidth / gridSize;
var animationDuration = 800;

function leftClick() {
  if (isAnimating) return;
  numImages--;
  if (numImages < 1) numImages = 4;
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
        const delay = (y * gridSize + x) * 20;
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
          transition: `opacity ${animationDuration}ms ease-in-out`
        });

        square.appendTo(".images");

        setTimeout(() => {
          square.css({ opacity: 1 });
        }, delay);
      }
    }

    // Задержка 
    setTimeout(() => { isAnimating = false; }, animationDuration + (gridSize * gridSize * 20) );
  }
}

$(document).ready(function() {
  
});





/*var numImages = 1;
var countDiv = 20;
var isAnimating = false; // Флаг, чтобы предотвратить одновременное нажатие кнопок

function leftClick() {
    if (isAnimating) return; // Предотвращаем нажатия во время анимации
    console.log("нажали кнопку <<");
    numImages--;
    if (numImages < 1) numImages = 3;  //  Цикличность: 1, 2, 3, 1, 2, 3...
    changeImages("left");
}

function rightClick() {
    if (isAnimating) return; // Предотвращаем нажатия во время анимации
    console.log("нажали кнопку >>");
    numImages++;
    if (numImages > 3) numImages = 1;  //  Цикличность
    changeImages("right");
}

function changeImages(direction) {
    isAnimating = true;  // Устанавливаем флаг анимации

    let delayTime = 0;
    let speedDelay = 50;  //  Более быстрая анимация
    let animationDuration = speedDelay * countDiv * 1.5; // Общая длительность анимации

    $(".images div").each(function() {
        delayTime++;
        let $this = $(this);
        let startPosition = direction === "right" ? "-80px" : "80px";  //  Начальная позиция для эффекта выезда
        let endPosition = "0px"; // Конечная позиция

        // Сначала делаем элементы невидимыми и сдвигаем их
        $this.css({
            'opacity': 0,
            'transform': `translateX(${startPosition})`
        });


        // Анимация
        setTimeout(function() {
            $this.css({
                'background-image': 'url("/imagegallery/' + numImages + '.jpg")',
                'transition': `opacity ${animationDuration}ms ease-in-out, transform ${animationDuration}ms ease-in-out`, // Добавляем transition
            });
            $this.css('background-position-x', '-' + ($this.index() * 1000) + 'px'); // Обновляем background-position

            // Показываем элементы, сдвигая их в нужное место
            $this.css({
                'opacity': 1,
                'transform': `translateX(${endPosition})`
            });


            // После завершения анимации
            setTimeout(function() {
                isAnimating = false; // Снимаем флаг анимации
            }, animationDuration);

        }, speedDelay * delayTime); // Добавляем небольшую задержку для каскадного эффекта
    });
}

jQuery(document).ready(function($) {
    for (let i = 0; i < countDiv; i++) {
        html = "<div></div>";
        let objectDiv = $(html);
        objectDiv.css({
            'width': '80px',
            'height': '100px', //  Увеличиваем высоту для лучшего эффекта
            'background-image': 'url("/imagegallery/' + numImages + '.jpg")',
            'background-position-x': '-' + i * 1000 + 'px',
            'background-size': 'auto 100px', // Увеличиваем высоту изображения
            'opacity': 0, // Скрываем изначально
            'transform': 'translateX(0px)', //  Устанавливаем начальное положение
            'transition': 'opacity 0s ease-in-out, transform 0s ease-in-out'  //  Удаляем transition, чтобы сбросить анимацию при загрузке
        });
        objectDiv.appendTo(".images");
    }
});*/







/*var numImages = 1;
var countDiv = 10;
var particleCount = 20;
var animationDuration = 500;
const imageBaseUrl = '/imagegallery/'; // Настройте этот путь

function leftClick() {
  console.log("нажали кнопку <<");
  numImages = Math.max(1, numImages - 1);
  changeImages();
}

function rightClick() {
  console.log("нажали кнопку >>");
  numImages++;
  changeImages();
}

function changeImages() {
  $(".images .image-container").each(function(index) {
    const $container = $(this);
    $container.empty();

    for (let i = 0; i < particleCount; i++) {
      const $particle = $('<div class="particle"></div>');
      const randomX = Math.random() * $container.width();
      const randomY = Math.random() * $container.height();

      $particle.css({
        position: 'absolute',
        left: randomX,
        top: randomY,
        width: '5px',
        height: '5px',
        backgroundImage: `url(${imageBaseUrl}${numImages}.jpg)`,
        backgroundPosition: `${-randomX}px ${-randomY}px`,
        transform: 'scale(0)',
        transition: `transform ${animationDuration}ms ease-in-out`
      });

      $container.append($particle);
      setTimeout(() => {
        $particle.css('transform', 'scale(1)');
      }, 0);
    }
  });
}

$(document).ready(function() {
  for (let i = 0; i < countDiv; i++) {
    const $div = $('<div class="image-container"></div>');
    $('.images').append($div);
  }
  changeImages();
});*/




/*var numImages = 1;
var countDiv = 10;

function leftClick()
{
	console.log("нажали кнопку <<");
	numImages--;
	changeImages();
	
	
}

function rightClick()
{
	console.log("нажали кнопку >>");
	numImages++;
	changeImages();
}

function changeImages()
{
	let delayTime = 0;
	let speedDelay = 100;
	$(".images div").each(function (){
		delayTime++;
		$(this).fadeOut(speedDelay*delayTime, function(){
			$(this).css('background-image', 'url("/imagegallery/' + numImages + '.jpg")');
			$(this).fadeIn(speedDelay*delayTime);
			
			}
		);
	
	})
}

jQuery(document).ready(function($) {
    for (let i = 0; i < countDiv; i++) {
        html = "<div></div>";
        let objectDiv = $(html);
       
        objectDiv.css('width', '80px');
       objectDiv.css('background-image', 'url("/imagegallery/' + numImages + '.jpg")');
		objectDiv.css('background-position-x', '-'+i*80+'px');
        objectDiv.appendTo(".images");
    }
});*/





