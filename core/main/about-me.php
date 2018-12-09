<main class="main" role="main">
    <div class="myghost">
    <h1>#1<span>About</span>-Me</h1>
    <a href="https://www.facebook.com/dnvuongis95" target="_blank">Facebook</a>
    <svg id="_02-ghost" data-name="02-ghost" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 428.59 578.3">
        <g id="ghost">
            <path class="ghost-1" d="M525.8,359.1c-14.13-49.54-5.28-101-19.23-150.5-17.89-63.48-71.35-100.45-136.9-100.32C275.42,108.45,209.31,210,214.14,297c2.07,37.22-1.26,74.93-7.23,111.67-6.13,37.67-11.24,113.73,35.23,132.32,20,8,54,2,56-14,0,0,16,48,44,48s42-8,50-26c0,0,18,32,42,26s32-38,32-38,12,18,44,8,26-46,26-46,4,10,26,8c40.34-3.67,31.08-52.35,9.79-70.89C548.35,415.57,534.19,388.52,525.8,359.1Z" transform="translate(-202.99 -108.27)"/>
            <ellipse class="ghost-2" cx="301.19" cy="204.79" rx="27.5" ry="13.46" transform="translate(-214.88 282.63) rotate(-64.94)"/>
            <ellipse class="ghost-2" cx="366.84" cy="199.5" rx="18.98" ry="28.99" transform="translate(-248.24 23.77) rotate(-19.24)"/>
            <path class="ghost-2" d="M313.51,247.06s37.69-8.57,45.9,17.53,5.88,52.54-13.29,46.82-19.27-42.63-19.27-42.63,2.67-15.55-13.06-12.95S308.23,247.9,313.51,247.06Z" transform="translate(-202.99 -108.27)"/>
            <ellipse class="ghost-3" cx="392.7" cy="234.43" rx="14.3" ry="5.57" transform="translate(-234.97 -43.6) rotate(-9.05)"/>
            <ellipse class="ghost-3" cx="275.24" cy="241.02" rx="4.9" ry="12.59" transform="translate(-221.67 350.59) rotate(-77.75)"/>
        </g>
        <ellipse id="shadow" class="ghost-4" cx="226.85" cy="555.06" rx="201.74" ry="23.25"/>
    </svg>
    <h2>403 - Trang này không support!</h2>
    </div>
</main>

<style>
    /* GENERAL ========================= */
    main {
        background: -webkit-radial-gradient(center, ellipse cover,  #009688 0%,#00796B 41%,#004D40 100%);
        display: flex;
        flex-direction: column;
        background-repeat: no-repeat;
        background-size: cover;
        justify-content: space-around;
        align-items: center;
        min-height: 100vh;
        font-family: 'Amatica SC', cursive;
        text-align: center;
        color: #fff;
        padding-bottom: 65px;
        font-size: 20px;
    }
    .myghost .ghost-bg{
        background: -webkit-radial-gradient(center, ellipse cover,  #009688 0%,#00796B 41%,#004D40 100%);
    }
    .myghost .spider-bg{
        background: -webkit-radial-gradient(center, ellipse cover,  #FFB300 0%,#FFA000 41%,#E65100 100%);
    }
    .myghost a {
        color: #fff;
        text-decoration:none;
        margin: 0;
        position: absolute;
        top: 10px;
        right: 20px;
    }
    .myghost h1, h2 {
        margin: 0;
    }
    .myghost h1 {
        position: fixed;
        top: 30px;
        font-size: 50px;
    }
    .myghost h1 span {
        color: #B2FF59;
    }
    .myghost h2 {
        font-size: 30px;
    }
    .myghost svg {
        height: 40vh;
    }
    .myghost svg:hover {
        cursor: pointer;
    }
    .myghost a {
        text-decoration: none;
        /* 	color: #FF6F00; */
    }

    .myghost footer {
        background: rgba(0,0,0,0.8);
        position: absolute;
        bottom: 0;
        width: 100%;
    }
    .ghost-1 {
        fill: #f5f5f5;
    }
    .ghost-2 {
        fill: #263238;
    }
    .ghost-3 {
        fill: #f8bbcf;
    }
    .ghost-4 {
        fill: #00695C;
    }
    #_02-ghost {
        position: relative;
        left: 0px;
    }

    #ghost {
        animation: floaty 1.75s infinite;
    }

    #shadow {
        animation: shadow 1.75s infinite;
        transform-origin: 50% 50%;
    }

    @keyframes shadow {
        0% {
            transform: scale(0.9);
        }

        50% {
            transform: scale(1);
        }

        100% {
            transform: scale(0.9);
        }
    }
    @keyframes floaty {
        0% {
            transform: translateY(25px);
        }

        50% {
            transform: translateY(0px);
        }

        100% {
            transform: translateY(25px);
        }
    }
</style>
<script type="text/javascript">
    var side,
        movingRight,
        max = 0,
        ghost = document.getElementById('_02-ghost');
    atBounds = () => {
        if (movingRight) {
            if (ghost.getBoundingClientRect().right >= max) {
                return true;
            }
        } else {
            if (ghost.getBoundingClientRect().left <= max) {
                return true;
            }
        }
        return false;
    }
    move = () => setTimeout(() => {
        if (!atBounds()) {
        ghost.style.left = String((parseInt(ghost.style.left) || 0) + side) + 'px';
    }
    if (side > 0) {
        ghost.style.transform = 'rotateY(180deg)';
        ghost.style.transformOrigin = '50% 50%';
    } else {
        ghost.style.transform = 'rotateY(0deg)';
        ghost.style.transformOrigin = '0% 0%';
    }
    move();
    }, 10);
    document.onmousemove = e => {
        movingRight = e.screenX > (window.innerWidth / 2);
        max = e.screenX;

        if (atBounds()) {
            side = 0;
            return;
        }
        side = e.screenX > (window.innerWidth / 2) ? 2 : -2;
    }
    move();
</script>
