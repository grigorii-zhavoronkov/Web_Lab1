let speed = -1;
let gravity = 0.03;
let maxvelocity = 3;
let minvelocity = -2;
let radius = 15.0;
let tube_hole = 120;
let bird;
let canvas;
let ctx;
let width = 400;
let height = 600;
let game = null;
let tubes = [];
let tube_counter = 0;
let point_counter = -650;
let points = 0;
let started = false;
let bg = new Image();
let bird_img = new Image();
let tube_img = new Image();

bg.src = "flappy_bird_res/background.png";
bird_img.src = "flappy_bird_res/bird.png";
tube_img.src = "flappy_bird_res/tube.png";


class Bird {
    constructor(x, y) {
        this.x = x;
        this.y = y;
        this.velocity = -1;
    }

    draw() {
        ctx.drawImage(bird_img, this.x - radius, this.y - radius, 30, 30);
    }
}

class Tube {
    constructor(x, y, height, isPair) {
        this.x = x;
        this.y = y;
        this.height = height;
        this.width = 50;
        this.isPair = isPair
    }

    draw() {
        if (this.isPair) {
            ctx.rotate(Math.PI);
            ctx.drawImage(tube_img, -this.x, -this.y, -this.width, -this.height);
            ctx.rotate(Math.PI);
        } else {
            ctx.drawImage(tube_img, this.x, this.y, this.width, this.height);
        }
    }
}

function drawPoints() {
    ctx.font = "30px Arial";
    ctx.fillStyle = "#000";
    ctx.fillText(points, 10, 40);
}

function drawHello() {
    ctx.font = "25px Arial";
    ctx.fillStyle = "#000";
    ctx.fillText("Нажмите пробел чтобы начать", 0, 285);
}

function drawBackground() {
    ctx.drawImage(bg, 0, 0, width, height);
}

function clear() {
    ctx.clearRect(0, 0, width, height);
}

function setup() {
    tubes = [];
    tube_counter = 0;
    point_counter = -650;
    points = 0;
    started = false;
    if (game == null) {
        canvas = document.getElementById("canvas");
        canvas.focus();
        ctx = canvas.getContext("2d");
        clear();
        drawBackground();
        bird = new Bird(75, 300);
        document.body.addEventListener("keydown", function (e) {
            if (e.key === " " && started) {
                bird.velocity -= 3.5;
                if (bird.velocity < minvelocity) {
                    bird.velocity = minvelocity;
                }
            } else if (e.key === " ") {
                started = true;
                start();
            }
        });
        drawHello();
    } else {
        console.log(1);
    }
}

function start() {
    game = setInterval(loop, 5);
}

function loop() {
    clear();
    drawBackground();
    tube_counter += 1;
    point_counter += 1;
    if (tube_counter % 250 === 0) {
        createTube();
        tube_counter = 0;
    }
    if (point_counter === 0) {
        point_counter = -250;
        points += 1;
        if (points === 10) {
            document.getElementById("back").classList.remove("hidden");
        }
    }
    for (let i = 0; i < tubes.length; i++) {
        if (tubes[i].x + tubes[i].width < 0) {
            tubes.splice(i, 1);
        } else {
            tubes[i].x += speed;
            tubes[i].draw();
        }
    }
    if (bird.y <= height && bird.y >= 0) {
        bird.velocity += gravity;
        if (bird.velocity > maxvelocity) {
            bird.velocity = maxvelocity
        } else if (bird.velocity < minvelocity) {
            bird.velocity = minvelocity;
        }
        bird.y += bird.velocity;
        bird.draw();
    } else {
        gameOver();
    }

    if (isCollision()) {
        gameOver();
    }
    drawPoints();

}

function isCollision() {
    let right = bird.x + radius/2;
    let left = bird.x - radius/2;
    let top = bird.y - radius/2;
    let bottom = bird.y + radius/2;
    for (let i = 0; i < tubes.length; i++) {
        let tube_x = tubes[i].x;
        let tube_y = tubes[i].y;
        if (!tubes[i].isPair && right >= tube_x && left <= tube_x + 50 &&
            bottom >= tube_y) {
            return true;
        } else if (tubes[i].isPair && right >= tube_x && left <= tube_x + 50 &&
            top <= tube_y) {
            return true;
        }
    }
    return false;
}

function createTube() {
    let height = Math.random()*600 + 100;
    if (height > 550) {
        height = 550;
    } else if (height < 200) {
        height = 200;
    }
    let tube = new Tube(width + 50, height, 1000, false);
    tubes.push(tube);
    let pair = new Tube(width + 50, height - tube_hole, -1000, true);
    tubes.push(pair);
}

function gameOver() {
    clearInterval(game);
    game = null;
    setup();
}