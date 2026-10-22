$j = jQuery.noConflict();

var scrollTime = 0.6;			//Scroll time
var scrollDistance = 400;		//Distance. Use smaller value for shorter scroll and greater value for longer scroll
var currentY = 0;
var targetY = 0;
var lastTime = 0;
var isAnimating = false;

mobile_ie = -1 !== navigator.userAgent.indexOf("IEMobile");

function getScrollY() {
	return window.pageYOffset || document.documentElement.scrollTop || 0;
}

function getMaxScroll() {
	return Math.max(0, document.documentElement.scrollHeight - window.innerHeight);
}

function clampScroll(y) {
	return Math.max(0, Math.min(y, getMaxScroll()));
}

function getWheelDelta(event) {
	var delta;

	if (typeof event.deltaY === "number") {
		if (event.deltaMode === 1) {
			delta = -event.deltaY / 3;
		} else if (event.deltaMode === 2) {
			delta = event.deltaY > 0 ? -1 : 1;
		} else {
			delta = -event.deltaY / 100;
		}
	} else if (typeof event.wheelDelta === "number") {
		delta = event.wheelDelta / 120;
	} else {
		delta = -event.detail / 3;
	}

	if (delta > 1) {
		delta = 1;
	} else if (delta < -1) {
		delta = -1;
	}

	return delta;
}

function setScrollY(y) {
	window.scrollTo(0, y);
}

function animateSmoothScroll(timestamp) {
	if (!lastTime) {
		lastTime = timestamp;
	}

	var dt = Math.min(timestamp - lastTime, 64) / 1000;
	lastTime = timestamp;

	// Exponential ease-out toward the target so extra wheel ticks retarget without a hitch
	currentY += (targetY - currentY) * (1 - Math.exp(-dt * 3 / scrollTime));

	if (Math.abs(targetY - currentY) < 0.5) {
		currentY = targetY;
		setScrollY(currentY);
		isAnimating = false;
		lastTime = 0;
		return;
	}

	setScrollY(currentY);
	window.requestAnimationFrame(animateSmoothScroll);
}

function smoothScrollListener(event) {
	event.preventDefault();

	var delta = getWheelDelta(event);

	if (!delta) {
		return;
	}

	if (!isAnimating) {
		currentY = getScrollY();
		targetY = currentY;
	}

	targetY = clampScroll(currentY - delta * scrollDistance);

	if (!isAnimating) {
		isAnimating = true;
		lastTime = 0;

		if (window.requestAnimationFrame) {
			window.requestAnimationFrame(animateSmoothScroll);
		} else {
			setScrollY(targetY);
			currentY = targetY;
			isAnimating = false;
		}
	}
}

if (!$j("html").hasClass("touch") && !mobile_ie) {
	if (window.addEventListener) {
		window.addEventListener("wheel", smoothScrollListener, {passive: false});
	}
}
