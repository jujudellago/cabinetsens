/*
 * Foundation Responsive Library
 * http://foundation.zurb.com
 * Copyright 2013, ZURB
 * Free to use under the MIT license.
 * http://www.opensource.org/licenses/mit-license.php
 */
/*jslint unparam: true, browser: true, indent: 2 */
// Accommodate running jQuery or Zepto in noConflict() mode by
// using an anonymous function to redefine the $ shorthand name.
// See http://docs.jquery.com/Using_jQuery_with_Other_Libraries
// and http://zeptojs.com/
var libFuncName = null;
if (typeof jQuery == "undefined" && typeof Zepto == "undefined" && typeof $ == "function") libFuncName = $;
else if (typeof jQuery == "function") libFuncName = jQuery;
else {
    if (typeof Zepto != "function") throw new TypeError;
    libFuncName = Zepto
}(function(e, t, n, r) {
    "use strict";
    t.matchMedia = t.matchMedia || function(e, t) {
        var n, r = e.documentElement,
            i = r.firstElementChild || r.firstChild,
            s = e.createElement("body"),
            o = e.createElement("div");
        return o.id = "mq-test-1", o.style.cssText = "position:absolute;top:-100em", s.style.background = "none", s.appendChild(o),
            function(e) {
                return o.innerHTML = '&shy;<style media="' + e + '"> #mq-test-1 { width: 42px; }</style>', r.insertBefore(s, i), n = o.offsetWidth === 42, r.removeChild(s), {
                    matches: n,
                    media: e
                }
            }
    }(n), Array.prototype.filter || (Array.prototype.filter = function(e) {
        if (this == null) throw new TypeError;
        var t = Object(this),
            n = t.length >>> 0;
        if (typeof e != "function") return;
        var r = [],
            i = arguments[1];
        for (var s = 0; s < n; s++)
            if (s in t) {
                var o = t[s];
                e && e.call(i, o, s, t) && r.push(o)
            }
        return r
    }), Function.prototype.bind || (Function.prototype.bind = function(e) {
        if (typeof this != "function") throw new TypeError("Function.prototype.bind - what is trying to be bound is not callable");
        var t = Array.prototype.slice.call(arguments, 1),
            n = this,
            r = function() {},
            i = function() {
                return n.apply(this instanceof r && e ? this : e, t.concat(Array.prototype.slice.call(arguments)))
            };
        return r.prototype = this.prototype, i.prototype = new r, i
    }), Array.prototype.indexOf || (Array.prototype.indexOf = function(e) {
        if (this == null) throw new TypeError;
        var t = Object(this),
            n = t.length >>> 0;
        if (n === 0) return -1;
        var r = 0;
        arguments.length > 1 && (r = Number(arguments[1]), r != r ? r = 0 : r != 0 && r != Infinity && r != -Infinity && (r = (r > 0 || -1) * Math.floor(Math.abs(r))));
        if (r >= n) return -1;
        var i = r >= 0 ? r : Math.max(n - Math.abs(r), 0);
        for (; i < n; i++)
            if (i in t && t[i] === e) return i;
        return -1
    }), e.fn.stop = e.fn.stop || function() {
        return this
    }, t.Foundation = {
        name: "Foundation",
        version: "4.2.0",
        cache: {},
        init: function(t, n, r, i, s, o) {
            var u, a = [t, r, i, s],
                f = [],
                o = o || !1;
            o && (this.nc = o), this.rtl = /rtl/i.test(e("html").attr("dir")), this.scope = t || this.scope;
            if (n && typeof n == "string" && !/reflow/i.test(n)) {
                if (/off/i.test(n)) return this.off();
                u = n.split(" ");
                if (u.length > 0)
                    for (var l = u.length - 1; l >= 0; l--) f.push(this.init_lib(u[l], a))
            } else {
                /reflow/i.test(n) && (a[1] = "reflow");
                for (var c in this.libs) f.push(this.init_lib(c, a))
            }
            return typeof n == "function" && a.unshift(n), this.response_obj(f, a)
        },
        response_obj: function(e, t) {
            for (var n = 0, r = t.length; n < r; n++)
                if (typeof t[n] == "function") return t[n]({
                    errors: e.filter(function(e) {
                        if (typeof e == "string") return e
                    })
                });
            return e
        },
        init_lib: function(e, t) {
            return this.trap(function() {
                return this.libs.hasOwnProperty(e) ? (this.patch(this.libs[e]), this.libs[e].init.apply(this.libs[e], t)) : function() {}
            }.bind(this), e)
        },
        trap: function(e, t) {
            if (!this.nc) try {
                return e()
            } catch (n) {
                return this.error({
                    name: t,
                    message: "could not be initialized",
                    more: n.name + " " + n.message
                })
            }
            return e()
        },
        patch: function(e) {
            this.fix_outer(e), e.scope = this.scope, e.rtl = this.rtl
        },
        inherit: function(e, t) {
            var n = t.split(" ");
            for (var r = n.length - 1; r >= 0; r--) this.lib_methods.hasOwnProperty(n[r]) && (this.libs[e.name][n[r]] = this.lib_methods[n[r]])
        },
        random_str: function(e) {
            var t = "0123456789ABCDEFGHIJKLMNOPQRSTUVWXTZabcdefghiklmnopqrstuvwxyz".split("");
            e || (e = Math.floor(Math.random() * t.length));
            var n = "";
            for (var r = 0; r < e; r++) n += t[Math.floor(Math.random() * t.length)];
            return n
        },
        libs: {},
        lib_methods: {
            set_data: function(e, t) {
                var n = [this.name, +(new Date), Foundation.random_str(5)].join("-");
                return Foundation.cache[n] = t, e.attr("data-" + this.name + "-id", n), t
            },
            get_data: function(e) {
                return Foundation.cache[e.attr("data-" + this.name + "-id")]
            },
            remove_data: function(t) {
                t ? (delete Foundation.cache[t.attr("data-" + this.name + "-id")], t.attr("data-" + this.name + "-id", "")) : e("[data-" + this.name + "-id]").each(function() {
                    delete Foundation.cache[e(this).attr("data-" + this.name + "-id")], e(this).attr("data-" + this.name + "-id", "")
                })
            },
            throttle: function(e, t) {
                var n = null;
                return function() {
                    var r = this,
                        i = arguments;
                    clearTimeout(n), n = setTimeout(function() {
                        e.apply(r, i)
                    }, t)
                }
            },
            data_options: function(t) {
                function u(e) {
                    return !isNaN(e - 0) && e !== null && e !== "" && e !== !1 && e !== !0
                }

                function a(t) {
                    return typeof t == "string" ? e.trim(t) : t
                }
                var n = {},
                    r, i, s = (t.attr("data-options") || ":").split(";"),
                    o = s.length;
                for (r = o - 1; r >= 0; r--) i = s[r].split(":"), /true/i.test(i[1]) && (i[1] = !0), /false/i.test(i[1]) && (i[1] = !1), u(i[1]) && (i[1] = parseInt(i[1], 10)), i.length === 2 && i[0].length > 0 && (n[a(i[0])] = a(i[1]));
                return n
            },
            delay: function(e, t) {
                return setTimeout(e, t)
            },
            scrollTo: function(n, r, i) {
                if (i < 0) return;
                var s = r - e(t).scrollTop(),
                    o = s / i * 10;
                this.scrollToTimerCache = setTimeout(function() {
                    isNaN(parseInt(o, 10)) || (t.scrollTo(0, e(t).scrollTop() + o), this.scrollTo(n, r, i - 10))
                }.bind(this), 10)
            },
            scrollLeft: function(e) {
                if (!e.length) return;
                return "scrollLeft" in e[0] ? e[0].scrollLeft : e[0].pageXOffset
            },
            empty: function(e) {
                if (e.length && e.length > 0) return !1;
                if (e.length && e.length === 0) return !0;
                for (var t in e)
                    if (hasOwnProperty.call(e, t)) return !1;
                return !0
            }
        },
        fix_outer: function(e) {
            e.outerHeight = function(e, t) {
                return typeof Zepto == "function" ? e.height() : typeof t != "undefined" ? e.outerHeight(t) : e.outerHeight()
            }, e.outerWidth = function(e) {
                return typeof Zepto == "function" ? e.width() : typeof bool != "undefined" ? e.outerWidth(bool) : e.outerWidth()
            }
        },
        error: function(e) {
            return e.name + " " + e.message + "; " + e.more
        },
        off: function() {
            return e(this.scope).off(".fndtn"), e(t).off(".fndtn"), !0
        },
        zj: function() {
            return typeof Zepto != "undefined" ? Zepto : jQuery
        }()
    }, e.fn.foundation = function() {
        var e = Array.prototype.slice.call(arguments, 0);
        return this.each(function() {
            return Foundation.init.apply(Foundation, [this].concat(e)), this
        })
    }
})(libFuncName, this, this.document),
function(e, t, n, r) {
    "use strict";
    Foundation.libs.alerts = {
        name: "alerts",
        version: "4.0.0",
        settings: {
            speed: 300,
            callback: function() {}
        },
        init: function(t, n, r) {
            return this.scope = t || this.scope, typeof n == "object" && e.extend(!0, this.settings, n), typeof n != "string" ? (this.settings.init || this.events(), this.settings.init) : this[n].call(this, r)
        },
        events: function() {
            var t = this;
            e(this.scope).on("click.fndtn.alerts", "[data-alert] a.close", function(n) {
                n.preventDefault(), e(this).closest("[data-alert]").fadeOut(t.speed, function() {
                    e(this).remove(), t.settings.callback()
                })
            }), this.settings.init = !0
        },
        off: function() {
            e(this.scope).off(".fndtn.alerts")
        },
        reflow: function() {}
    }
}(Foundation.zj, this, this.document),
function(e, t, n, r) {
    "use strict";
    Foundation.libs.clearing = {
        name: "clearing",
        version: "4.1.3",
        settings: {
            templates: {
                viewing: '<a href="#" class="clearing-close">&times;</a><div class="visible-img" style="display: none"><img src="//:0"><p class="clearing-caption"></p><a href="#" class="clearing-main-prev"><span></span></a><a href="#" class="clearing-main-next"><span></span></a></div>'
            },
            close_selectors: ".clearing-close",
            init: !1,
            locked: !1
        },
        init: function(t, n, r) {
            var i = this;
            return Foundation.inherit(this, "set_data get_data remove_data throttle data_options"), typeof n == "object" && (r = e.extend(!0, this.settings, n)), typeof n != "string" ? (e(this.scope).find("ul[data-clearing]").each(function() {
                var t = e(this),
                    n = n || {},
                    r = t.find("li"),
                    s = i.get_data(t);
                !s && r.length > 0 && (n.$parent = t.parent(), i.set_data(t, e.extend({}, i.settings, n, i.data_options(t))), i.assemble(t.find("li")), i.settings.init || i.events().swipe_events())
            }), this.settings.init) : this[n].call(this, r)
        },
        events: function() {
            var n = this;
            return e(this.scope).on("click.fndtn.clearing", "ul[data-clearing] li", function(t, r, i) {
                var r = r || e(this),
                    i = i || r,
                    s = r.next("li"),
                    o = n.get_data(r.parent()),
                    u = e(t.target);
                t.preventDefault(), o || n.init(), i.hasClass("visible") && r[0] === i[0] && s.length > 0 && n.is_open(r) && (i = s, u = i.find("img")), n.open(u, r, i), n.update_paddles(i)
            }).on("click.fndtn.clearing", ".clearing-main-next", function(e) {
                this.nav(e, "next")
            }.bind(this)).on("click.fndtn.clearing", ".clearing-main-prev", function(e) {
                this.nav(e, "prev")
            }.bind(this)).on("click.fndtn.clearing", this.settings.close_selectors, function(e) {
                Foundation.libs.clearing.close(e, this)
            }).on("keydown.fndtn.clearing", function(e) {
                this.keydown(e)
            }.bind(this)), e(t).on("resize.fndtn.clearing", function() {
                this.resize()
            }.bind(this)), this.settings.init = !0, this
        },
        swipe_events: function() {
            var t = this;
            e(this.scope).on("touchstart.fndtn.clearing", ".visible-img", function(t) {
                t.touches || (t = t.originalEvent);
                var n = {
                    start_page_x: t.touches[0].pageX,
                    start_page_y: t.touches[0].pageY,
                    start_time: (new Date).getTime(),
                    delta_x: 0,
                    is_scrolling: r
                };
                e(this).data("swipe-transition", n), t.stopPropagation()
            }).on("touchmove.fndtn.clearing", ".visible-img", function(n) {
                n.touches || (n = n.originalEvent);
                if (n.touches.length > 1 || n.scale && n.scale !== 1) return;
                var r = e(this).data("swipe-transition");
                typeof r == "undefined" && (r = {}), r.delta_x = n.touches[0].pageX - r.start_page_x, typeof r.is_scrolling == "undefined" && (r.is_scrolling = !!(r.is_scrolling || Math.abs(r.delta_x) < Math.abs(n.touches[0].pageY - r.start_page_y)));
                if (!r.is_scrolling && !r.active) {
                    n.preventDefault();
                    var i = r.delta_x < 0 ? "next" : "prev";
                    r.active = !0, t.nav(n, i)
                }
            }).on("touchend.fndtn.clearing", ".visible-img", function(t) {
                e(this).data("swipe-transition", {}), t.stopPropagation()
            })
        },
        assemble: function(t) {
            var n = t.parent();
            n.after('<div id="foundationClearingHolder"></div>');
            var r = e("#foundationClearingHolder"),
                i = this.get_data(n),
                s = n.detach(),
                o = {
                    grid: '<div class="carousel">' + this.outerHTML(s[0]) + "</div>",
                    viewing: i.templates.viewing
                },
                u = '<div class="clearing-assembled"><div>' + o.viewing + o.grid + "</div></div>";
            return r.after(u).remove()
        },
        open: function(e, t, n) {
            var r = n.closest(".clearing-assembled"),
                i = r.find("div").first(),
                s = i.find(".visible-img"),
                o = s.find("img").not(e);
            this.locked() || (o.attr("src", this.load(e)).css("visibility", "hidden"), this.loaded(o, function() {
                o.css("visibility", "visible"), r.addClass("clearing-blackout"), i.addClass("clearing-container"), s.show(), this.fix_height(n).caption(s.find(".clearing-caption"), e).center(o).shift(t, n, function() {
                    n.siblings().removeClass("visible"), n.addClass("visible")
                })
            }.bind(this)))
        },
        close: function(t, n) {
            t.preventDefault();
            var r = function(e) {
                    return /blackout/.test(e.selector) ? e : e.closest(".clearing-blackout")
                }(e(n)),
                i, s;
            return n === t.target && r && (i = r.find("div").first(), s = i.find(".visible-img"), this.settings.prev_index = 0, r.find("ul[data-clearing]").attr("style", "").closest(".clearing-blackout").removeClass("clearing-blackout"), i.removeClass("clearing-container"), s.hide()), !1
        },
        is_open: function(e) {
            return e.parent().attr("style").length > 0
        },
        keydown: function(t) {
            var n = e(".clearing-blackout").find("ul[data-clearing]");
            t.which === 39 && this.go(n, "next"), t.which === 37 && this.go(n, "prev"), t.which === 27 && e("a.clearing-close").trigger("click")
        },
        nav: function(t, n) {
            var r = e(".clearing-blackout").find("ul[data-clearing]");
            t.preventDefault(), this.go(r, n)
        },
        resize: function() {
            var t = e(".clearing-blackout .visible-img").find("img");
            t.length && this.center(t)
        },
        fix_height: function(t) {
            var n = t.parent().children(),
                r = this;
            return n.each(function() {
                var t = e(this),
                    n = t.find("img");
                t.height() > r.outerHeight(n) && t.addClass("fix-height")
            }).closest("ul").width(n.length * 100 + "%"), this
        },
        update_paddles: function(e) {
            var t = e.closest(".carousel").siblings(".visible-img");
            e.next().length > 0 ? t.find(".clearing-main-next").removeClass("disabled") : t.find(".clearing-main-next").addClass("disabled"), e.prev().length > 0 ? t.find(".clearing-main-prev").removeClass("disabled") : t.find(".clearing-main-prev").addClass("disabled")
        },
        center: function(e) {
            return this.rtl ? e.css({
                marginRight: -(this.outerWidth(e) / 2),
                marginTop: -(this.outerHeight(e) / 2)
            }) : e.css({
                marginLeft: -(this.outerWidth(e) / 2),
                marginTop: -(this.outerHeight(e) / 2)
            }), this
        },
        load: function(e) {
            if (e[0].nodeName === "A") var t = e.attr("href");
            else var t = e.parent().attr("href");
            return this.preload(e), t ? t : e.attr("src")
        },
        preload: function(e) {
            this.img(e.closest("li").next()).img(e.closest("li").prev())
        },
        loaded: function(e, t) {
            function n() {
                t()
            }

            function r() {
                this.one("load", n);
                if (/MSIE (\d+\.\d+);/.test(navigator.userAgent)) {
                    var e = this.attr("src"),
                        t = e.match(/\?/) ? "&" : "?";
                    t += "random=" + (new Date).getTime(), this.attr("src", e + t)
                }
            }
            if (!e.attr("src")) {
                n();
                return
            }
            e[0].complete || e[0].readyState === 4 ? n() : r.call(e)
        },
        img: function(e) {
            if (e.length) {
                var t = new Image,
                    n = e.find("a");
                n.length ? t.src = n.attr("href") : t.src = e.find("img").attr("src")
            }
            return this
        },
        caption: function(e, t) {
            var n = t.data("caption");
            return n ? e.html(n).show() : e.text("").hide(), this
        },
        go: function(e, t) {
            var n = e.find(".visible"),
                r = n[t]();
            r.length && r.find("img").trigger("click", [n, r])
        },
        shift: function(e, t, n) {
            var r = t.parent(),
                i = this.settings.prev_index || t.index(),
                s = this.direction(r, e, t),
                o = parseInt(r.css("left"), 10),
                u = this.outerWidth(t),
                a;
            t.index() !== i && !/skip/.test(s) ? /left/.test(s) ? (this.lock(), r.animate({
                left: o + u
            }, 300, this.unlock())) : /right/.test(s) && (this.lock(), r.animate({
                left: o - u
            }, 300, this.unlock())) : /skip/.test(s) && (a = t.index() - this.settings.up_count, this.lock(), a > 0 ? r.animate({
                left: -(a * u)
            }, 300, this.unlock()) : r.animate({
                left: 0
            }, 300, this.unlock())), n()
        },
        direction: function(t, n, r) {
            var i = t.find("li"),
                s = this.outerWidth(i) + this.outerWidth(i) / 4,
                o = Math.floor(this.outerWidth(e(".clearing-container")) / s) - 1,
                u = i.index(r),
                a;
            return this.settings.up_count = o, this.adjacent(this.settings.prev_index, u) ? u > o && u > this.settings.prev_index ? a = "right" : u > o - 1 && u <= this.settings.prev_index ? a = "left" : a = !1 : a = "skip", this.settings.prev_index = u, a
        },
        adjacent: function(e, t) {
            for (var n = t + 1; n >= t - 1; n--)
                if (n === e) return !0;
            return !1
        },
        lock: function() {
            this.settings.locked = !0
        },
        unlock: function() {
            this.settings.locked = !1
        },
        locked: function() {
            return this.settings.locked
        },
        outerHTML: function(e) {
            return e.outerHTML || (new XMLSerializer).serializeToString(e)
        },
        off: function() {
            e(this.scope).off(".fndtn.clearing"), e(t).off(".fndtn.clearing"), this.remove_data(), this.settings.init = !1
        },
        reflow: function() {
            this.init()
        }
    }
}(Foundation.zj, this, this.document),
function(e, t, n) {
    function i(e) {
        return e
    }

    function s(e) {
        return decodeURIComponent(e.replace(r, " "))
    }
    var r = /\+/g,
        o = e.cookie = function(r, u, a) {
            if (u !== n) {
                a = e.extend({}, o.defaults, a), u === null && (a.expires = -1);
                if (typeof a.expires == "number") {
                    var f = a.expires,
                        l = a.expires = new Date;
                    l.setDate(l.getDate() + f)
                }
                return u = o.json ? JSON.stringify(u) : String(u), t.cookie = [encodeURIComponent(r), "=", o.raw ? u : encodeURIComponent(u), a.expires ? "; expires=" + a.expires.toUTCString() : "", a.path ? "; path=" + a.path : "", a.domain ? "; domain=" + a.domain : "", a.secure ? "; secure" : ""].join("")
            }
            var c = o.raw ? i : s,
                h = t.cookie.split("; ");
            for (var p = 0, d = h.length; p < d; p++) {
                var v = h[p].split("=");
                if (c(v.shift()) === r) {
                    var m = c(v.join("="));
                    return o.json ? JSON.parse(m) : m
                }
            }
            return null
        };
    o.defaults = {}, e.removeCookie = function(t, n) {
        return e.cookie(t) !== null ? (e.cookie(t, null, n), !0) : !1
    }
}(Foundation.zj, document),
function(e, t, n, r) {
    "use strict";
    Foundation.libs.dropdown = {
        name: "dropdown",
        version: "4.2.0",
        settings: {
            activeClass: "open",
            is_hover: !1,
            opened: function() {},
            closed: function() {}
        },
        init: function(t, n, r) {
            return this.scope = t || this.scope, Foundation.inherit(this, "throttle scrollLeft data_options"), typeof n == "object" && e.extend(!0, this.settings, n), typeof n != "string" ? (this.settings.init || this.events(), this.settings.init) : this[n].call(this, r)
        },
        events: function() {
            var n = this;
            e(this.scope).on("click.fndtn.dropdown", "[data-dropdown]", function(t) {
                var r = e.extend({}, n.settings, n.data_options(e(this)));
                t.preventDefault(), r.is_hover || n.toggle(e(this))
            }).on("mouseenter", "[data-dropdown]", function(t) {
                var r = e.extend({}, n.settings, n.data_options(e(this)));
                r.is_hover && n.toggle(e(this))
            }).on("mouseleave", "[data-dropdown-content]", function(t) {
                var r = e('[data-dropdown="' + e(this).attr("id") + '"]'),
                    i = e.extend({}, n.settings, n.data_options(r));
                i.is_hover && n.close.call(n, e(this))
            }).on("opened.fndtn.dropdown", "[data-dropdown-content]", this.settings.opened).on("closed.fndtn.dropdown", "[data-dropdown-content]", this.settings.closed), e("body").on("click.fndtn.dropdown", function(t) {
                var r = e(t.target).closest("[data-dropdown-content]");
                if (e(t.target).data("dropdown")) return;
                if (r.length > 0 && (e(t.target).is("[data-dropdown-content]") || e.contains(r.first()[0], t.target))) {
                    t.stopPropagation();
                    return
                }
                n.close.call(n, e("[data-dropdown-content]"))
            }), e(t).on("resize.fndtn.dropdown", n.throttle(function() {
                n.resize.call(n)
            }, 50)).trigger("resize"), this.settings.init = !0
        },
        close: function(t) {
            var n = this;
            t.each(function() {
                e(this).hasClass(n.settings.activeClass) && (e(this).css(Foundation.rtl ? "right" : "left", "-99999px").removeClass(n.settings.activeClass), e(this).trigger("closed"))
            })
        },
        open: function(e, t) {
            this.css(e.addClass(this.settings.activeClass), t), e.trigger("opened")
        },
        toggle: function(t) {
            var n = e("#" + t.data("dropdown"));
            this.close.call(this, e("[data-dropdown-content]").not(n)), n.hasClass(this.settings.activeClass) ? this.close.call(this, n) : (this.close.call(this, e("[data-dropdown-content]")), this.open.call(this, n, t))
        },
        resize: function() {
            var t = e("[data-dropdown-content].open"),
                n = e("[data-dropdown='" + t.attr("id") + "']");
            t.length && n.length && this.css(t, n)
        },
        css: function(n, r) {
            var i = n.offsetParent();
            if (i.length > 0 && /body/i.test(n.offsetParent()[0].nodeName)) {
                var s = r.offset();
                s.top -= n.offsetParent().offset().top, s.left -= n.offsetParent().offset().left
            } else var s = r.position();
            if (this.small()) n.css({
                position: "absolute",
                width: "95%",
                left: "2.5%",
                "max-width": "none",
                top: s.top + this.outerHeight(r)
            });
            else {
                if (!Foundation.rtl && e(t).width() > this.outerWidth(n) + r.offset().left) {
                    var o = s.left;
                    n.hasClass("right") && n.removeClass("right")
                } else {
                    n.hasClass("right") || n.addClass("right");
                    var o = s.left - (this.outerWidth(n) - this.outerWidth(r))
                }
                n.attr("style", "").css({
                    position: "absolute",
                    top: s.top + this.outerHeight(r),
                    left: o
                })
            }
            return n
        },
        small: function() {
            return e(t).width() < 768 || e("html").hasClass("lt-ie9")
        },
        off: function() {
            e(this.scope).off(".fndtn.dropdown"), e("html, body").off(".fndtn.dropdown"), e(t).off(".fndtn.dropdown"), e("[data-dropdown-content]").off(".fndtn.dropdown"), this.settings.init = !1
        },
        reflow: function() {}
    }
}(Foundation.zj, this, this.document),
function(e, t, n, r) {
    "use strict";
    Foundation.libs.forms = {
        name: "forms",
        version: "4.2.1",
        cache: {},
        settings: {
            disable_class: "no-custom",
            last_combo: null
        },
        init: function(t, n, r) {
            return typeof n == "object" && e.extend(!0, this.settings, n), typeof n != "string" ? (this.settings.init || this.events(), this.assemble(), this.settings.init) : this[n].call(this, r)
        },
        assemble: function() {
            e('form.custom input[type="radio"]', e(this.scope)).not('[data-customforms="disabled"]').each(this.append_custom_markup), e('form.custom input[type="checkbox"]', e(this.scope)).not('[data-customforms="disabled"]').each(this.append_custom_markup), e("form.custom select", e(this.scope)).not('[data-customforms="disabled"]').not("[multiple=multiple]").each(this.append_custom_select)
        },
        events: function() {
            var r = this;
            e(this.scope).on("click.fndtn.forms", "form.custom span.custom.checkbox", function(t) {
                t.preventDefault(), t.stopPropagation(), r.toggle_checkbox(e(this))
            }).on("click.fndtn.forms", "form.custom span.custom.radio", function(t) {
                t.preventDefault(), t.stopPropagation(), r.toggle_radio(e(this))
            }).on("change.fndtn.forms", 'form.custom select:not([data-customforms="disabled"])', function(t, n) {
                r.refresh_custom_select(e(this), n)
            }).on("click.fndtn.forms", "form.custom label", function(t) {
                if (e(t.target).is("label")) {
                    var n = e("#" + r.escape(e(this).attr("for")) + ':not([data-customforms="disabled"])'),
                        i, s;
                    n.length !== 0 && (n.attr("type") === "checkbox" ? (t.preventDefault(), i = e(this).find("span.custom.checkbox"), i.length == 0 && (i = n.add(this).siblings("span.custom.checkbox").first()), r.toggle_checkbox(i)) : n.attr("type") === "radio" && (t.preventDefault(), s = e(this).find("span.custom.radio"), s.length == 0 && (s = n.add(this).siblings("span.custom.radio").first()), r.toggle_radio(s)))
                }
            }).on("mousedown.fndtn.forms", "form.custom div.custom.dropdown", function() {
                return !1
            }).on("click.fndtn.forms", "form.custom div.custom.dropdown a.current, form.custom div.custom.dropdown a.selector", function(t) {
                var n = e(this),
                    s = n.closest("div.custom.dropdown"),
                    o = i(s, "select");
                s.hasClass("open") || e(r.scope).trigger("click"), t.preventDefault();
                if (!1 === o.is(":disabled")) return s.toggleClass("open"), s.hasClass("open") ? e(r.scope).on("click.fndtn.forms.customdropdown", function() {
                    s.removeClass("open"), e(r.scope).off(".fndtn.forms.customdropdown")
                }) : e(r.scope).on(".fndtn.forms.customdropdown"), !1
            }).on("click.fndtn.forms touchend.fndtn.forms", "form.custom div.custom.dropdown li", function(t) {
                var n = e(this),
                    r = n.closest("div.custom.dropdown"),
                    s = i(r, "select"),
                    o = 0;
                t.preventDefault(), t.stopPropagation();
                if (!e(this).hasClass("disabled")) {
                    e("div.dropdown").not(r).removeClass("open");
                    var u = n.closest("ul").find("li.selected");
                    u.removeClass("selected"), n.addClass("selected"), r.removeClass("open").find("a.current").text(n.text()), n.closest("ul").find("li").each(function(e) {
                        n[0] == this && (o = e)
                    }), s[0].selectedIndex = o, s.data("prevalue", u.html()), s.trigger("change")
                }
            }), e(t).on("keydown", function(t) {
                var r = n.activeElement,
                    i = Foundation.libs.forms,
                    s = e(".custom.dropdown.open");
                if (s.length > 0) {
                    t.preventDefault(), t.which === 13 && s.find("li.selected").trigger("click"), t.which === 27 && s.removeClass("open");
                    if (t.which >= 65 && t.which <= 90) {
                        var o = i.go_to(s, t.which),
                            u = s.find("li.selected");
                        o && (u.removeClass("selected"), i.scrollTo(o.addClass("selected"), 300))
                    }
                    if (t.which === 38) {
                        var u = s.find("li.selected"),
                            a = u.prev(":not(.disabled)");
                        a.length > 0 && (a.parent()[0].scrollTop = a.parent().scrollTop() - i.outerHeight(a), u.removeClass("selected"), a.addClass("selected"))
                    } else if (t.which === 40) {
                        var u = s.find("li.selected"),
                            o = u.next(":not(.disabled)");
                        o.length > 0 && (o.parent()[0].scrollTop = o.parent().scrollTop() + i.outerHeight(o), u.removeClass("selected"), o.addClass("selected"))
                    }
                }
            }), this.settings.init = !0
        },
        go_to: function(e, t) {
            var n = e.find("li"),
                r = n.length;
            if (r > 0)
                for (var i = 0; i < r; i++) {
                    var s = n.eq(i).text().charAt(0).toLowerCase();
                    if (s === String.fromCharCode(t).toLowerCase()) return n.eq(i)
                }
        },
        scrollTo: function(e, t) {
            if (t < 0) return;
            var n = e.parent(),
                r = this.outerHeight(e),
                i = r * e.index() - n.scrollTop(),
                s = i / t * 10;
            this.scrollToTimerCache = setTimeout(function() {
                isNaN(parseInt(s, 10)) || (n[0].scrollTop = n.scrollTop() + s, this.scrollTo(e, t - 10))
            }.bind(this), 10)
        },
        append_custom_markup: function(t, n) {
            var r = e(n),
                i = r.attr("type"),
                s = r.next("span.custom." + i);
            s.length === 0 && (s = e('<span class="custom ' + i + '"></span>').insertAfter(r)), s.toggleClass("checked", r.is(":checked")), s.toggleClass("disabled", r.is(":disabled"))
        },
        append_custom_select: function(t, n) {
            var r = Foundation.libs.forms,
                i = e(n),
                s = i.next("div.custom.dropdown"),
                o = s.find("ul"),
                u = s.find(".current"),
                a = s.find(".selector"),
                f = i.find("option"),
                l = f.filter(":selected"),
                c = i.attr("class") ? i.attr("class").split(" ") : [],
                h = 0,
                p = "",
                d, v = !1;
            if (i.hasClass(r.settings.disable_class)) return;
            if (s.length === 0) {
                var m = i.hasClass("small") ? "small" : i.hasClass("medium") ? "medium" : i.hasClass("large") ? "large" : i.hasClass("expand") ? "expand" : "";
                s = e('<div class="' + ["custom", "dropdown", m].concat(c).filter(function(e, t, n) {
                    return e == "" ? !1 : n.indexOf(e) == t
                }).join(" ") + '"><a href="#" class="selector"></a><ul /></div>'), a = s.find(".selector"), o = s.find("ul"), p = f.map(function() {
                    var t = e(this).attr("class") ? e(this).attr("class") : "";
                    return "<li class='" + t + "'>" + e(this).html() + "</li>"
                }).get().join(""), o.append(p), v = s.prepend('<a href="#" class="current">' + l.html() + "</a>").find(".current"), i.after(s).addClass("hidden-field")
            } else p = f.map(function() {
                return "<li>" + e(this).html() + "</li>"
            }).get().join(""), o.html("").append(p);
            r.assign_id(i, s), s.toggleClass("disabled", i.is(":disabled")), d = o.find("li"), r.cache[s.data("id")] = d.length, f.each(function(t) {
                this.selected && (d.eq(t).addClass("selected"), v && v.html(e(this).html())), e(this).is(":disabled") && d.eq(t).addClass("disabled")
            });
            if (!s.is(".small, .medium, .large, .expand")) {
                s.addClass("open");
                var r = Foundation.libs.forms;
                r.hidden_fix.adjust(o), h = r.outerWidth(d) > h ? r.outerWidth(d) : h, Foundation.libs.forms.hidden_fix.reset(), s.removeClass("open")
            }
        },
        assign_id: function(e, t) {
            var n = [+(new Date), Foundation.random_str(5)].join("-");
            e.attr("data-id", n), t.attr("data-id", n)
        },
        refresh_custom_select: function(t, n) {
            var r = this,
                i = 0,
                s = t.next(),
                o = t.find("option"),
                u = s.find("li");
            if (u.length != this.cache[s.data("id")] || n) s.find("ul").html(""), o.each(function() {
                var t = e("<li>" + e(this).html() + "</li>");
                s.find("ul").append(t)
            }), o.each(function(t) {
                this.selected && (s.find("li").eq(t).addClass("selected"), s.find(".current").html(e(this).html())), e(this).is(":disabled") && s.find("li").eq(t).addClass("disabled")
            }), s.removeAttr("style").find("ul").removeAttr("style"), s.find("li").each(function() {
                s.addClass("open"), r.outerWidth(e(this)) > i && (i = r.outerWidth(e(this))), s.removeClass("open")
            }), u = s.find("li"), this.cache[s.data("id")] = u.length
        },
        toggle_checkbox: function(e) {
            var t = e.prev(),
                n = t[0];
            !1 === t.is(":disabled") && (n.checked = n.checked ? !1 : !0, e.toggleClass("checked"), t.trigger("change"))
        },
        toggle_radio: function(e) {
            var t = e.prev(),
                n = t.closest("form.custom"),
                r = t[0];
            !1 === t.is(":disabled") && (n.find('input[type="radio"][name="' + this.escape(t.attr("name")) + '"]').next().not(e).removeClass("checked"), e.hasClass("checked") || e.toggleClass("checked"), r.checked = e.hasClass("checked"), t.trigger("change"))
        },
        escape: function(e) {
            return e.replace(/[-[\]{}()*+?.,\\^$|#\s]/g, "\\$&")
        },
        hidden_fix: {
            tmp: [],
            hidden: null,
            adjust: function(t) {
                var n = this;
                n.hidden = t.parents(), n.hidden = n.hidden.add(t).filter(":hidden"), n.hidden.each(function() {
                    var t = e(this);
                    n.tmp.push(t.attr("style")), t.css({
                        visibility: "hidden",
                        display: "block"
                    })
                })
            },
            reset: function() {
                var t = this;
                t.hidden.each(function(n) {
                    var i = e(this),
                        s = t.tmp[n];
                    s === r ? i.removeAttr("style") : i.attr("style", s)
                }), t.tmp = [], t.hidden = null
            }
        },
        off: function() {
            e(this.scope).off(".fndtn.forms")
        },
        reflow: function() {}
    };
    var i = function(t, n) {
        var t = t.prev();
        while (t.length) {
            if (t.is(n)) return t;
            t = t.prev()
        }
        return e()
    }
}(Foundation.zj, this, this.document),
function(e, t, n, r) {
    "use strict";
    Foundation.libs.joyride = {
        name: "joyride",
        version: "4.2.0",
        defaults: {
            expose: !1,
            modal: !1,
            tipLocation: "bottom",
            nubPosition: "auto",
            scrollSpeed: 300,
            timer: 0,
            startTimerOnClick: !0,
            startOffset: 0,
            nextButton: !0,
            tipAnimation: "fade",
            pauseAfter: [],
            exposed: [],
            tipAnimationFadeSpeed: 300,
            cookieMonster: !1,
            cookieName: "joyride",
            cookieDomain: !1,
            cookieExpires: 365,
            tipContainer: "body",
            postRideCallback: function() {},
            postStepCallback: function() {},
            preStepCallback: function() {},
            preRideCallback: function() {},
            postExposeCallback: function() {},
            template: {
                link: '<a href="#close" class="joyride-close-tip">&times;</a>',
                timer: '<div class="joyride-timer-indicator-wrap"><span class="joyride-timer-indicator"></span></div>',
                tip: '<div class="joyride-tip-guide"><span class="joyride-nub"></span></div>',
                wrapper: '<div class="joyride-content-wrapper"></div>',
                button: '<a href="#" class="small button joyride-next-tip"></a>',
                modal: '<div class="joyride-modal-bg"></div>',
                expose: '<div class="joyride-expose-wrapper"></div>',
                exposeCover: '<div class="joyride-expose-cover"></div>'
            },
            exposeAddClass: ""
        },
        settings: {},
        init: function(t, n, r) {
            return this.scope = t || this.scope, Foundation.inherit(this, "throttle data_options scrollTo scrollLeft delay"), typeof n == "object" ? e.extend(!0, this.settings, this.defaults, n) : e.extend(!0, this.settings, this.defaults, r), typeof n != "string" ? (this.settings.init || this.events(), this.settings.init) : this[n].call(this, r)
        },
        events: function() {
            var n = this;
            e(this.scope).on("click.joyride", ".joyride-next-tip, .joyride-modal-bg", function(e) {
                e.preventDefault(), this.settings.$li.next().length < 1 ? this.end() : this.settings.timer > 0 ? (clearTimeout(this.settings.automate), this.hide(), this.show(), this.startTimer()) : (this.hide(), this.show())
            }.bind(this)).on("click.joyride", ".joyride-close-tip", function(e) {
                e.preventDefault(), this.end()
            }.bind(this)), e(t).on("resize.fndtn.joyride", n.throttle(function() {
                if (e("[data-joyride]").length > 0 && n.settings.$next_tip) {
                    if (n.settings.exposed.length > 0) {
                        var t = e(n.settings.exposed);
                        t.each(function() {
                            var t = e(this);
                            n.un_expose(t), n.expose(t)
                        })
                    }
                    n.is_phone() ? n.pos_phone() : n.pos_default(!1, !0)
                }
            }, 100)), this.settings.init = !0
        },
        start: function() {
            var t = this,
                n = e(this.scope).find("[data-joyride]"),
                r = ["timer", "scrollSpeed", "startOffset", "tipAnimationFadeSpeed", "cookieExpires"],
                i = r.length;
            this.settings.init || this.init(), this.settings.$content_el = n, this.settings.$body = e(this.settings.tipContainer), this.settings.body_offset = e(this.settings.tipContainer).position(), this.settings.$tip_content = this.settings.$content_el.find("> li"), this.settings.paused = !1, this.settings.attempts = 0, this.settings.tipLocationPatterns = {
                top: ["bottom"],
                bottom: [],
                left: ["right", "top", "bottom"],
                right: ["left", "top", "bottom"]
            }, typeof e.cookie != "function" && (this.settings.cookieMonster = !1);
            if (!this.settings.cookieMonster || this.settings.cookieMonster && e.cookie(this.settings.cookieName) === null) this.settings.$tip_content.each(function(n) {
                var s = e(this);
                e.extend(!0, t.settings, t.data_options(s));
                for (var o = i - 1; o >= 0; o--) t.settings[r[o]] = parseInt(t.settings[r[o]], 10);
                t.create({
                    $li: s,
                    index: n
                })
            }), !this.settings.startTimerOnClick && this.settings.timer > 0 ? (this.show("init"), this.startTimer()) : this.show("init")
        },
        resume: function() {
            this.set_li(), this.show()
        },
        tip_template: function(t) {
            var n, r;
            return t.tip_class = t.tip_class || "", n = e(this.settings.template.tip).addClass(t.tip_class), r = e.trim(e(t.li).html()) + this.button_text(t.button_text) + this.settings.template.link + this.timer_instance(t.index), n.append(e(this.settings.template.wrapper)), n.first().attr("data-index", t.index), e(".joyride-content-wrapper", n).append(r), n[0]
        },
        timer_instance: function(t) {
            var n;
            return t === 0 && this.settings.startTimerOnClick && this.settings.timer > 0 || this.settings.timer === 0 ? n = "" : n = this.outerHTML(e(this.settings.template.timer)[0]), n
        },
        button_text: function(t) {
            return this.settings.nextButton ? (t = e.trim(t) || "Next", t = this.outerHTML(e(this.settings.template.button).append(t)[0])) : t = "", t
        },
        create: function(t) {
            var n = t.$li.attr("data-button") || t.$li.attr("data-text"),
                r = t.$li.attr("class"),
                i = e(this.tip_template({
                    tip_class: r,
                    index: t.index,
                    button_text: n,
                    li: t.$li
                }));
            e(this.settings.tipContainer).append(i)
        },
        show: function(t) {
            var n = null;
            this.settings.$li === r || e.inArray(this.settings.$li.index(), this.settings.pauseAfter) === -1 ? (this.settings.paused ? this.settings.paused = !1 : this.set_li(t), this.settings.attempts = 0, this.settings.$li.length && this.settings.$target.length > 0 ? (t && (this.settings.preRideCallback(this.settings.$li.index(), this.settings.$next_tip), this.settings.modal && this.show_modal()), this.settings.preStepCallback(this.settings.$li.index(), this.settings.$next_tip), this.settings.modal && this.settings.expose && this.expose(), this.settings.tipSettings = e.extend(this.settings, this.data_options(this.settings.$li)), this.settings.timer = parseInt(this.settings.timer, 10), this.settings.tipSettings.tipLocationPattern = this.settings.tipLocationPatterns[this.settings.tipSettings.tipLocation], /body/i.test(this.settings.$target.selector) || this.scroll_to(), this.is_phone() ? this.pos_phone(!0) : this.pos_default(!0), n = this.settings.$next_tip.find(".joyride-timer-indicator"), /pop/i.test(this.settings.tipAnimation) ? (n.width(0), this.settings.timer > 0 ? (this.settings.$next_tip.show(), this.delay(function() {
                n.animate({
                    width: n.parent().width()
                }, this.settings.timer, "linear")
            }.bind(this), this.settings.tipAnimationFadeSpeed)) : this.settings.$next_tip.show()) : /fade/i.test(this.settings.tipAnimation) && (n.width(0), this.settings.timer > 0 ? (this.settings.$next_tip.fadeIn(this.settings.tipAnimationFadeSpeed).show(), this.delay(function() {
                n.animate({
                    width: n.parent().width()
                }, this.settings.timer, "linear")
            }.bind(this), this.settings.tipAnimationFadeSpeed)) : this.settings.$next_tip.fadeIn(this.settings.tipAnimationFadeSpeed)), this.settings.$current_tip = this.settings.$next_tip) : this.settings.$li && this.settings.$target.length < 1 ? this.show() : this.end()) : this.settings.paused = !0
        },
        is_phone: function() {
            return Modernizr ? Modernizr.mq("only screen and (max-width: 767px)") || e(".lt-ie9").length > 0 : this.settings.$window.width() < 767
        },
        hide: function() {
            this.settings.modal && this.settings.expose && this.un_expose(), this.settings.modal || e(".joyride-modal-bg").hide(), this.settings.$current_tip.hide(), this.settings.postStepCallback(this.settings.$li.index(), this.settings.$current_tip)
        },
        set_li: function(e) {
            e ? (this.settings.$li = this.settings.$tip_content.eq(this.settings.startOffset), this.set_next_tip(), this.settings.$current_tip = this.settings.$next_tip) : (this.settings.$li = this.settings.$li.next(), this.set_next_tip()), this.set_target()
        },
        set_next_tip: function() {
            this.settings.$next_tip = e(".joyride-tip-guide[data-index='" + this.settings.$li.index() + "']"), this.settings.$next_tip.data("closed", "")
        },
        set_target: function() {
            var t = this.settings.$li.attr("data-class"),
                r = this.settings.$li.attr("data-id"),
                i = function() {
                    return r ? e(n.getElementById(r)) : t ? e("." + t).first() : e("body")
                };
            this.settings.$target = i()
        },
        scroll_to: function() {
            var n, r;
            n = e(t).height() / 2, r = Math.ceil(this.settings.$target.offset().top - n + this.outerHeight(this.settings.$next_tip)), r > 0 && this.scrollTo(e("html, body"), r, this.settings.scrollSpeed)
        },
        paused: function() {
            return e.inArray(this.settings.$li.index() + 1, this.settings.pauseAfter) === -1
        },
        restart: function() {
            this.hide(), this.settings.$li = r, this.show("init")
        },
        pos_default: function(n, r) {
            var i = Math.ceil(e(t).height() / 2),
                s = this.settings.$next_tip.offset(),
                o = this.settings.$next_tip.find(".joyride-nub"),
                u = Math.ceil(this.outerWidth(o) / 2),
                a = Math.ceil(this.outerHeight(o) / 2),
                f = n || !1;
            f && (this.settings.$next_tip.css("visibility", "hidden"), this.settings.$next_tip.show()), typeof r == "undefined" && (r = !1);
            if (!/body/i.test(this.settings.$target.selector)) {
                if (this.bottom()) {
                    var l = this.settings.$target.offset().left;
                    Foundation.rtl && (l = this.settings.$target.offset().width - this.settings.$next_tip.width() + l), this.settings.$next_tip.css({
                        top: this.settings.$target.offset().top + a + this.outerHeight(this.settings.$target),
                        left: l
                    }), this.nub_position(o, this.settings.tipSettings.nubPosition, "top")
                } else if (this.top()) {
                    var l = this.settings.$target.offset().left;
                    Foundation.rtl && (l = this.settings.$target.offset().width - this.settings.$next_tip.width() + l), this.settings.$next_tip.css({
                        top: this.settings.$target.offset().top - this.outerHeight(this.settings.$next_tip) - a,
                        left: l
                    }), this.nub_position(o, this.settings.tipSettings.nubPosition, "bottom")
                } else this.right() ? (this.settings.$next_tip.css({
                    top: this.settings.$target.offset().top,
                    left: this.outerWidth(this.settings.$target) + this.settings.$target.offset().left + u
                }), this.nub_position(o, this.settings.tipSettings.nubPosition, "left")) : this.left() && (this.settings.$next_tip.css({
                    top: this.settings.$target.offset().top,
                    left: this.settings.$target.offset().left - this.outerWidth(this.settings.$next_tip) - u
                }), this.nub_position(o, this.settings.tipSettings.nubPosition, "right"));
                !this.visible(this.corners(this.settings.$next_tip)) && this.settings.attempts < this.settings.tipSettings.tipLocationPattern.length && (o.removeClass("bottom").removeClass("top").removeClass("right").removeClass("left"), this.settings.tipSettings.tipLocation = this.settings.tipSettings.tipLocationPattern[this.settings.attempts], this.settings.attempts++, this.pos_default())
            } else this.settings.$li.length && this.pos_modal(o);
            f && (this.settings.$next_tip.hide(), this.settings.$next_tip.css("visibility", "visible"))
        },
        pos_phone: function(t) {
            var n = this.outerHeight(this.settings.$next_tip),
                r = this.settings.$next_tip.offset(),
                i = this.outerHeight(this.settings.$target),
                s = e(".joyride-nub", this.settings.$next_tip),
                o = Math.ceil(this.outerHeight(s) / 2),
                u = t || !1;
            s.removeClass("bottom").removeClass("top").removeClass("right").removeClass("left"), u && (this.settings.$next_tip.css("visibility", "hidden"), this.settings.$next_tip.show()), /body/i.test(this.settings.$target.selector) ? this.settings.$li.length && this.pos_modal(s) : this.top() ? (this.settings.$next_tip.offset({
                top: this.settings.$target.offset().top - n - o
            }), s.addClass("bottom")) : (this.settings.$next_tip.offset({
                top: this.settings.$target.offset().top + i + o
            }), s.addClass("top")), u && (this.settings.$next_tip.hide(), this.settings.$next_tip.css("visibility", "visible"))
        },
        pos_modal: function(e) {
            this.center(), e.hide(), this.show_modal()
        },
        show_modal: function() {
            if (!this.settings.$next_tip.data("closed")) {
                var t = e(".joyride-modal-bg");
                t.length < 1 && e("body").append(this.settings.template.modal).show(), /pop/i.test(this.settings.tipAnimation) ? t.show() : t.fadeIn(this.settings.tipAnimationFadeSpeed)
            }
        },
        expose: function() {
            var n, r, i, s, o, u = "expose-" + Math.floor(Math.random() * 1e4);
            if (arguments.length > 0 && arguments[0] instanceof e) i = arguments[0];
            else {
                if (!this.settings.$target || !!/body/i.test(this.settings.$target.selector)) return !1;
                i = this.settings.$target
            }
            if (i.length < 1) return t.console && console.error("element not valid", i), !1;
            n = e(this.settings.template.expose), this.settings.$body.append(n), n.css({
                top: i.offset().top,
                left: i.offset().left,
                width: this.outerWidth(i, !0),
                height: this.outerHeight(i, !0)
            }), r = e(this.settings.template.exposeCover), s = {
                zIndex: i.css("z-index"),
                position: i.css("position")
            }, o = i.attr("class") == null ? "" : i.attr("class"), i.css("z-index", parseInt(n.css("z-index")) + 1), s.position == "static" && i.css("position", "relative"), i.data("expose-css", s), i.data("orig-class", o), i.attr("class", o + " " + this.settings.exposeAddClass), r.css({
                top: i.offset().top,
                left: i.offset().left,
                width: this.outerWidth(i, !0),
                height: this.outerHeight(i, !0)
            }), this.settings.$body.append(r), n.addClass(u), r.addClass(u), i.data("expose", u), this.settings.postExposeCallback(this.settings.$li.index(), this.settings.$next_tip, i), this.add_exposed(i)
        },
        un_expose: function() {
            var n, r, i, s, o, u = !1;
            if (arguments.length > 0 && arguments[0] instanceof e) r = arguments[0];
            else {
                if (!this.settings.$target || !!/body/i.test(this.settings.$target.selector)) return !1;
                r = this.settings.$target
            }
            if (r.length < 1) return t.console && console.error("element not valid", r), !1;
            n = r.data("expose"), i = e("." + n), arguments.length > 1 && (u = arguments[1]), u === !0 ? e(".joyride-expose-wrapper,.joyride-expose-cover").remove() : i.remove(), s = r.data("expose-css"), s.zIndex == "auto" ? r.css("z-index", "") : r.css("z-index", s.zIndex), s.position != r.css("position") && (s.position == "static" ? r.css("position", "") : r.css("position", s.position)), o = r.data("orig-class"), r.attr("class", o), r.removeData("orig-classes"), r.removeData("expose"), r.removeData("expose-z-index"), this.remove_exposed(r)
        },
        add_exposed: function(t) {
            this.settings.exposed = this.settings.exposed || [], t instanceof e || typeof t == "object" ? this.settings.exposed.push(t[0]) : typeof t == "string" && this.settings.exposed.push(t)
        },
        remove_exposed: function(t) {
            var n, r;
            t instanceof e ? n = t[0] : typeof t == "string" && (n = t), this.settings.exposed = this.settings.exposed || [], r = this.settings.exposed.length;
            for (var i = 0; i < r; i++)
                if (this.settings.exposed[i] == n) {
                    this.settings.exposed.splice(i, 1);
                    return
                }
        },
        center: function() {
            var n = e(t);
            return this.settings.$next_tip.css({
                top: (n.height() - this.outerHeight(this.settings.$next_tip)) / 2 + n.scrollTop(),
                left: (n.width() - this.outerWidth(this.settings.$next_tip)) / 2 + this.scrollLeft(n)
            }), !0
        },
        bottom: function() {
            return /bottom/i.test(this.settings.tipSettings.tipLocation)
        },
        top: function() {
            return /top/i.test(this.settings.tipSettings.tipLocation)
        },
        right: function() {
            return /right/i.test(this.settings.tipSettings.tipLocation)
        },
        left: function() {
            return /left/i.test(this.settings.tipSettings.tipLocation)
        },
        corners: function(n) {
            var r = e(t),
                i = r.height() / 2,
                s = Math.ceil(this.settings.$target.offset().top - i + this.settings.$next_tip.outerHeight()),
                o = r.width() + this.scrollLeft(r),
                u = r.height() + s,
                a = r.height() + r.scrollTop(),
                f = r.scrollTop();
            return s < f && (s < 0 ? f = 0 : f = s), u > a && (a = u), [n.offset().top < f, o < n.offset().left + n.outerWidth(), a < n.offset().top + n.outerHeight(), this.scrollLeft(r) > n.offset().left]
        },
        visible: function(e) {
            var t = e.length;
            while (t--)
                if (e[t]) return !1;
            return !0
        },
        nub_position: function(e, t, n) {
            t === "auto" ? e.addClass(n) : e.addClass(t)
        },
        startTimer: function() {
            this.settings.$li.length ? this.settings.automate = setTimeout(function() {
                this.hide(), this.show(), this.startTimer()
            }.bind(this), this.settings.timer) : clearTimeout(this.settings.automate)
        },
        end: function() {
            this.settings.cookieMonster && e.cookie(this.settings.cookieName, "ridden", {
                expires: this.settings.cookieExpires,
                domain: this.settings.cookieDomain
            }), this.settings.timer > 0 && clearTimeout(this.settings.automate), this.settings.modal && this.settings.expose && this.un_expose(), this.settings.$next_tip.data("closed", !0), e(".joyride-modal-bg").hide(), this.settings.$current_tip.hide(), this.settings.postStepCallback(this.settings.$li.index(), this.settings.$current_tip), this.settings.postRideCallback(this.settings.$li.index(), this.settings.$current_tip), e(".joyride-tip-guide").remove()
        },
        outerHTML: function(e) {
            return e.outerHTML || (new XMLSerializer).serializeToString(e)
        },
        off: function() {
            e(this.scope).off(".joyride"), e(t).off(".joyride"), e(".joyride-close-tip, .joyride-next-tip, .joyride-modal-bg").off(".joyride"), e(".joyride-tip-guide, .joyride-modal-bg").remove(), clearTimeout(this.settings.automate), this.settings = {}
        },
        reflow: function() {}
    }
}(Foundation.zj, this, this.document),
function(e, t, n, r) {
    "use strict";
    Foundation.libs.magellan = {
        name: "magellan",
        version: "4.2.0",
        settings: {
            activeClass: "active"
        },
        init: function(t, n, r) {
            return this.scope = t || this.scope, Foundation.inherit(this, "data_options"), typeof n == "object" && e.extend(!0, this.settings, n), typeof n != "string" ? (this.settings.init || (this.fixed_magellan = e("[data-magellan-expedition]"), this.set_threshold(), this.last_destination = e("[data-magellan-destination]").last(), this.events()), this.settings.init) : this[n].call(this, r)
        },
        events: function() {
            var n = this;
            e(this.scope).on("arrival.fndtn.magellan", "[data-magellan-arrival]", function(t) {
                var r = e(this),
                    i = r.closest("[data-magellan-expedition]"),
                    s = i.attr("data-magellan-active-class") || n.settings.activeClass;
                r.closest("[data-magellan-expedition]").find("[data-magellan-arrival]").not(r).removeClass(s), r.addClass(s)
            }), this.fixed_magellan.on("update-position.fndtn.magellan", function() {
                var t = e(this)
            }).trigger("update-position"), e(t).on("resize.fndtn.magellan", function() {
                this.fixed_magellan.trigger("update-position")
            }.bind(this)).on("scroll.fndtn.magellan", function() {
                var r = e(t).scrollTop();
                n.fixed_magellan.each(function() {
                    var t = e(this);
                    typeof t.data("magellan-top-offset") == "undefined" && t.data("magellan-top-offset", t.offset().top), typeof t.data("magellan-fixed-position") == "undefined" && t.data("magellan-fixed-position", !1);
                    var i = r + n.settings.threshold > t.data("magellan-top-offset"),
                        s = t.attr("data-magellan-top-offset");
                    t.data("magellan-fixed-position") != i && (t.data("magellan-fixed-position", i), i ? t.css({
                        position: "fixed",
                        top: 0
                    }) : t.css({
                        position: "",
                        top: ""
                    }), i && typeof s != "undefined" && s != 0 && t.css({
                        position: "fixed",
                        top: s + "px"
                    }))
                })
            }), this.last_destination.length > 0 && e(t).on("scroll.fndtn.magellan", function(r) {
                var i = e(t).scrollTop(),
                    s = i + e(t).height(),
                    o = Math.ceil(n.last_destination.offset().top);
                e("[data-magellan-destination]").each(function() {
                    var t = e(this),
                        r = t.attr("data-magellan-destination"),
                        u = t.offset().top - i;
                    u <= n.settings.threshold && e("[data-magellan-arrival='" + r + "']").trigger("arrival"), s >= e(n.scope).height() && o > i && o < s && e("[data-magellan-arrival]").last().trigger("arrival")
                })
            }), this.settings.init = !0
        },
        set_threshold: function() {
            this.settings.threshold || (this.settings.threshold = this.fixed_magellan.length > 0 ? this.outerHeight(this.fixed_magellan, !0) : 0)
        },
        off: function() {
            e(this.scope).off(".fndtn.magellan")
        },
        reflow: function() {}
    }
}(Foundation.zj, this, this.document),
function(e, t, n, r) {
    "use strict";
    Foundation.libs = Foundation.libs || {}, Foundation.libs.orbit = {
        name: "orbit",
        version: "4.2.0",
        settings: {
            timer_speed: 1e4,
            pause_on_hover: !0,
            resume_on_mouseout: !1,
            animation_speed: 500,
            bullets: !0,
            stack_on_small: !0,
            navigation_arrows: !0,
            slide_number: !0,
            container_class: "orbit-container",
            stack_on_small_class: "orbit-stack-on-small",
            next_class: "orbit-next",
            prev_class: "orbit-prev",
            timer_container_class: "orbit-timer",
            timer_paused_class: "paused",
            timer_progress_class: "orbit-progress",
            slides_container_class: "orbit-slides-container",
            bullets_container_class: "orbit-bullets",
            bullets_active_class: "active",
            slide_number_class: "orbit-slide-number",
            caption_class: "orbit-caption",
            active_slide_class: "active",
            orbit_transition_class: "orbit-transitioning"
        },
        init: function(t, n, r) {
            var i = this;
            Foundation.inherit(i, "data_options"), typeof n == "object" && e.extend(!0, i.settings, n);
            if (e(t).is("[data-orbit]")) {
                var s = e.extend(!0, {}, i);
                s._init(idx, el)
            }
            e("[data-orbit]", t).each(function(t, n) {
                var r = e.extend(!0, {}, i);
                r._init(t, n)
            })
        },
        _container_html: function() {
            var e = this;
            return '<div class="' + e.settings.container_class + '"></div>'
        },
        _bullets_container_html: function(t) {
            var n = this,
                r = e('<ol class="' + n.settings.bullets_container_class + '"></ol>');
            return t.each(function(t, i) {
                var s = e('<li data-orbit-slide-number="' + (t + 1) + '" class=""></li>');
                t === 0 && s.addClass(n.settings.bullets_active_class), r.append(s)
            }), r
        },
        _slide_number_html: function(t, n) {
            var r = this,
                i = e('<div class="' + r.settings.slide_number_class + '"></div>');
            return i.append("<span>" + t + "</span> of <span>" + n + "</span>"), i
        },
        _timer_html: function() {
            var e = this;
            return typeof e.settings.timer_speed == "number" && e.settings.timer_speed > 0 ? '<div class="' + e.settings.timer_container_class + '"><span></span><div class="' + e.settings.timer_progress_class + '"></div></div>' : ""
        },
        _next_html: function() {
            var e = this;
            return '<a href="#" class="' + e.settings.next_class + '">Next <span></span></a>'
        },
        _prev_html: function() {
            var e = this;
            return '<a href="#" class="' + e.settings.prev_class + '">Prev <span></span></a>'
        },
        _init: function(t, n) {
            var r = this,
                i = e(n),
                s = i.wrap(r._container_html()).parent(),
                o = i.children();
            e.extend(!0, r.settings, r.data_options(i)), r.settings.navigation_arrows && (s.append(r._prev_html()), s.append(r._next_html())), i.addClass(r.settings.slides_container_class), r.settings.stack_on_small && s.addClass(r.settings.stack_on_small_class), r.settings.slide_number && s.append(r._slide_number_html(1, o.length)), s.append(r._timer_html()), r.settings.bullets && s.after(r._bullets_container_html(o)), i.append(o.first().clone().attr("data-orbit-slide", "")), i.prepend(o.last().clone().attr("data-orbit-slide", "")), i.css(Foundation.rtl ? "marginRight" : "marginLeft", "-100%"), o.first().addClass(r.settings.active_slide_class), r._init_events(i), r._init_dimensions(i), r._start_timer(i)
        },
        _init_events: function(i) {
            var s = this,
                o = i.parent();
            e(t).on("load.fndtn.orbit", function() {
                i.height(""), i.height(i.height(o.height())), i.trigger("orbit:ready")
            }).on("resize.fndtn.orbit", function() {
                i.height(""), i.height(i.height(o.height()))
            }), e(n).on("click.fndtn.orbit", "[data-orbit-link]", function(t) {
                t.preventDefault();
                var n = e(t.currentTarget).attr("data-orbit-link"),
                    r = i.find("[data-orbit-slide=" + n + "]").first();
                r.length === 1 && (s._reset_timer(i, !0), s._goto(i, r.index(), function() {}))
            }), o.siblings("." + s.settings.bullets_container_class).on("click.fndtn.orbit", "[data-orbit-slide-number]", function(t) {
                t.preventDefault(), s._reset_timer(i, !0), s._goto(i, e(t.currentTarget).data("orbit-slide-number"), function() {})
            }), o.on("mouseenter.fndtn.orbit", function(e) {
                s.settings.pause_on_hover && s._stop_timer(i)
            }).on("mouseleave.fndtn.orbit", function(e) {
                s.settings.resume_on_mouseout && s._start_timer(i)
            }).on("orbit:after-slide-change.fndtn.orbit", function(e, t) {
                var n = o.find("." + s.settings.slide_number_class);
                n.length === 1 && n.replaceWith(s._slide_number_html(t.slide_number, t.total_slides))
            }).on("orbit:next-slide.fndtn.orbit click.fndtn.orbit", "." + s.settings.next_class, function(e) {
                e.preventDefault(), s._reset_timer(i, !0), s._goto(i, "next", function() {})
            }).on("orbit:prev-slide.fndtn.orbit click.fndtn.orbit", "." + s.settings.prev_class, function(e) {
                e.preventDefault(), s._reset_timer(i, !0), s._goto(i, "prev", function() {})
            }).on("orbit:toggle-play-pause.fndtn.orbit click.fndtn.orbit touchstart.fndtn.orbit", "." + s.settings.timer_container_class, function(t) {
                t.preventDefault();
                var n = e(t.currentTarget).toggleClass(s.settings.timer_paused_class),
                    r = n.closest("." + s.settings.container_class).find("." + s.settings.slides_container_class);
                n.hasClass(s.settings.timer_paused_class) ? s._stop_timer(r) : s._start_timer(r)
            }).on("touchstart.fndtn.orbit", function(e) {
                e.touches || (e = e.originalEvent);
                var t = {
                    start_page_x: e.touches[0].pageX,
                    start_page_y: e.touches[0].pageY,
                    start_time: (new Date).getTime(),
                    delta_x: 0,
                    is_scrolling: r
                };
                o.data("swipe-transition", t), e.stopPropagation()
            }).on("touchmove.fndtn.orbit", function(e) {
                e.touches || (e = e.originalEvent);
                if (e.touches.length > 1 || e.scale && e.scale !== 1) return;
                var t = o.data("swipe-transition");
                typeof t == "undefined" && (t = {}), t.delta_x = e.touches[0].pageX - t.start_page_x, typeof t.is_scrolling == "undefined" && (t.is_scrolling = !!(t.is_scrolling || Math.abs(t.delta_x) < Math.abs(e.touches[0].pageY - t.start_page_y)));
                if (!t.is_scrolling && !t.active) {
                    e.preventDefault(), s._stop_timer(i);
                    var n = t.delta_x < 0 ? "next" : "prev";
                    t.active = !0, s._goto(i, n, function() {})
                }
            }).on("touchend.fndtn.orbit", function(e) {
                o.data("swipe-transition", {}), e.stopPropagation()
            })
        },
        _init_dimensions: function(e) {
            var t = e.parent(),
                n = e.children();
            e.css("width", n.length * 100 + "%"), n.css("width", 100 / n.length + "%"), e.height(t.height()), e.css("width", n.length * 100 + "%")
        },
        _start_timer: function(e) {
            var t = this,
                n = e.parent(),
                r = function() {
                    t._reset_timer(e, !1), t._goto(e, "next", function() {
                        t._start_timer(e)
                    })
                },
                i = n.find("." + t.settings.timer_container_class),
                s = i.find("." + t.settings.timer_progress_class),
                o = s.width() / i.width(),
                u = t.settings.timer_speed - o * t.settings.timer_speed;
            s.animate({
                width: "100%"
            }, u, "linear", r), e.trigger("orbit:timer-started")
        },
        _stop_timer: function(e) {
            var t = this,
                n = e.parent(),
                r = n.find("." + t.settings.timer_container_class),
                i = r.find("." + t.settings.timer_progress_class),
                s = i.width() / r.width();
            t._rebuild_timer(n, s * 100 + "%"), e.trigger("orbit:timer-stopped"), r = n.find("." + t.settings.timer_container_class), r.addClass(t.settings.timer_paused_class)
        },
        _reset_timer: function(e, t) {
            var n = this,
                r = e.parent();
            n._rebuild_timer(r, "0%");
            if (typeof t == "boolean" && t) {
                var i = r.find("." + n.settings.timer_container_class);
                i.addClass(n.settings.timer_paused_class)
            }
        },
        _rebuild_timer: function(t, n) {
            var r = this,
                i = t.find("." + r.settings.timer_container_class),
                s = e(r._timer_html()),
                o = s.find("." + r.settings.timer_progress_class);
            if (typeof Zepto == "function") i.remove(), t.append(s), o.css("width", n);
            else if (typeof jQuery == "function") {
                var u = i.find("." + r.settings.timer_progress_class);
                u.css("width", n), u.stop()
            }
        },
        _goto: function(t, n, r) {
            var i = this,
                s = t.parent(),
                o = t.children(),
                u = t.find("." + i.settings.active_slide_class),
                a = u.index(),
                f = Foundation.rtl ? "marginRight" : "marginLeft";
            if (s.hasClass(i.settings.orbit_transition_class)) return !1;
            n === "prev" ? a === 0 ? a = o.length - 1 : a-- : n === "next" ? a = (a + 1) % o.length : typeof n == "number" && (a = n % o.length), a === o.length - 1 && n === "next" ? (t.css(f, "0%"), a = 1) : a === 0 && n === "prev" && (t.css(f, "-" + (o.length - 1) * 100 + "%"), a = o.length - 2), s.addClass(i.settings.orbit_transition_class), u.removeClass(i.settings.active_slide_class), e(o[a]).addClass(i.settings.active_slide_class);
            var l = s.siblings("." + i.settings.bullets_container_class);
            l.length === 1 && (l.children().removeClass(i.settings.bullets_active_class), e(l.children()[a - 1]).addClass(i.settings.bullets_active_class));
            var c = "-" + a * 100 + "%";
            t.trigger("orbit:before-slide-change");
            if (t.css(f) === c) s.removeClass(i.settings.orbit_transition_class), t.trigger("orbit:after-slide-change", [{
                slide_number: a,
                total_slides: t.children().length - 2
            }]), r();
            else {
                var h = {};
                h[f] = c, t.animate(h, i.settings.animation_speed, "linear", function() {
                    s.removeClass(i.settings.orbit_transition_class), t.trigger("orbit:after-slide-change", [{
                        slide_number: a,
                        total_slides: t.children().length - 2
                    }]), r()
                })
            }
        }
    }
}(Foundation.zj, this, this.document),
function(e, t, n) {
    function f(e) {
        var t = {},
            r = /^jQuery\d+$/;
        return n.each(e.attributes, function(e, n) {
            n.specified && !r.test(n.name) && (t[n.name] = n.value)
        }), t
    }

    function l(e, r) {
        var i = this,
            s = n(i);
        if (i.value == s.attr("placeholder") && s.hasClass("placeholder"))
            if (s.data("placeholder-password")) {
                s = s.hide().next().show().attr("id", s.removeAttr("id").data("placeholder-id"));
                if (e === !0) return s[0].value = r;
                s.focus()
            } else i.value = "", s.removeClass("placeholder"), i == t.activeElement && i.select()
    }

    function c() {
        var e, t = this,
            r = n(t),
            i = r,
            s = this.id;
        if (t.value == "") {
            if (t.type == "password") {
                if (!r.data("placeholder-textinput")) {
                    try {
                        e = r.clone().attr({
                            type: "text"
                        })
                    } catch (o) {
                        e = n("<input>").attr(n.extend(f(this), {
                            type: "text"
                        }))
                    }
                    e.removeAttr("name").data({
                        "placeholder-password": !0,
                        "placeholder-id": s
                    }).bind("focus.placeholder", l), r.data({
                        "placeholder-textinput": e,
                        "placeholder-id": s
                    }).before(e)
                }
                r = r.removeAttr("id").hide().prev().attr("id", s).show()
            }
            r.addClass("placeholder"), r[0].value = r.attr("placeholder")
        } else r.removeClass("placeholder")
    }
    var r = "placeholder" in t.createElement("input"),
        i = "placeholder" in t.createElement("textarea"),
        s = n.fn,
        o = n.valHooks,
        u, a;
    r && i ? (a = s.placeholder = function() {
        return this
    }, a.input = a.textarea = !0) : (a = s.placeholder = function() {
        var e = this;
        return e.filter((r ? "textarea" : ":input") + "[placeholder]").not(".placeholder").bind({
            "focus.placeholder": l,
            "blur.placeholder": c
        }).data("placeholder-enabled", !0).trigger("blur.placeholder"), e
    }, a.input = r, a.textarea = i, u = {
        get: function(e) {
            var t = n(e);
            return t.data("placeholder-enabled") && t.hasClass("placeholder") ? "" : e.value
        },
        set: function(e, r) {
            var i = n(e);
            return i.data("placeholder-enabled") ? (r == "" ? (e.value = r, e != t.activeElement && c.call(e)) : i.hasClass("placeholder") ? l.call(e, !0, r) || (e.value = r) : e.value = r, i) : e.value = r
        }
    }, r || (o.input = u), i || (o.textarea = u), n(function() {
        n(t).delegate("form", "submit.placeholder", function() {
            var e = n(".placeholder", this).each(l);
            setTimeout(function() {
                e.each(c)
            }, 10)
        })
    }), n(e).bind("beforeunload.placeholder", function() {
        n(".placeholder").each(function() {
            this.value = ""
        })
    }))
}(this, document, Foundation.zj),
function(e, t, n, r) {
    "use strict";
    Foundation.libs.reveal = {
        name: "reveal",
        version: "4.2.0",
        locked: !1,
        settings: {
            animation: "fadeAndPop",
            animationSpeed: 250,
            closeOnBackgroundClick: !0,
            closeOnEsc: !0,
            dismissModalClass: "close-reveal-modal",
            bgClass: "reveal-modal-bg",
            open: function() {},
            opened: function() {},
            close: function() {},
            closed: function() {},
            bg: e(".reveal-modal-bg"),
            css: {
                open: {
                    opacity: 0,
                    visibility: "visible",
                    display: "block"
                },
                close: {
                    opacity: 1,
                    visibility: "hidden",
                    display: "none"
                }
            }
        },
        init: function(t, n, r) {
            return Foundation.inherit(this, "data_options delay"), typeof n == "object" ? e.extend(!0, this.settings, n) : typeof r != "undefined" && e.extend(!0, this.settings, r), typeof n != "string" ? (this.events(), this.settings.init) : this[n].call(this, r)
        },
        events: function() {
            var t = this;
            return e(this.scope).off(".fndtn.reveal").on("click.fndtn.reveal", "[data-reveal-id]", function(n) {
                n.preventDefault();
                if (!t.locked) {
                    var r = e(this),
                        i = r.data("reveal-ajax");
                    t.locked = !0;
                    if (typeof i == "undefined") t.open.call(t, r);
                    else {
                        var s = i === !0 ? r.attr("href") : i;
                        t.open.call(t, r, {
                            url: s
                        })
                    }
                }
            }).on("click.fndtn.reveal touchend.click.fndtn.reveal", this.close_targets(), function(n) {
                n.preventDefault();
                if (!t.locked) {
                    var r = e.extend({}, t.settings, t.data_options(e(".reveal-modal.open")));
                    if (e(n.target)[0] === e("." + r.bgClass)[0] && !r.closeOnBackgroundClick) return;
                    t.locked = !0, t.close.call(t, e(this).closest(".reveal-modal"))
                }
            }).on("open.fndtn.reveal", ".reveal-modal", this.settings.open).on("opened.fndtn.reveal", ".reveal-modal", this.settings.opened).on("opened.fndtn.reveal", ".reveal-modal", this.open_video).on("close.fndtn.reveal", ".reveal-modal", this.settings.close).on("closed.fndtn.reveal", ".reveal-modal", this.settings.closed).on("closed.fndtn.reveal", ".reveal-modal", this.close_video), e("body").bind("keyup.reveal", function(n) {
                var r = e(".reveal-modal.open"),
                    i = e.extend({}, t.settings, t.data_options(r));
                n.which === 27 && i.closeOnEsc && r.foundation("reveal", "close")
            }), !0
        },
        open: function(t, n) {
            if (t)
                if (typeof t.selector != "undefined") var r = e("#" + t.data("reveal-id"));
                else {
                    var r = e(this.scope);
                    n = t
                } else var r = e(this.scope);
            if (!r.hasClass("open")) {
                var i = e(".reveal-modal.open");
                typeof r.data("css-top") == "undefined" && r.data("css-top", parseInt(r.css("top"), 10)).data("offset", this.cache_offset(r)), r.trigger("open"), i.length < 1 && this.toggle_bg(r);
                if (typeof n == "undefined" || !n.url) this.hide(i, this.settings.css.close), this.show(r, this.settings.css.open);
                else {
                    var s = this,
                        o = typeof n.success != "undefined" ? n.success : null;
                    e.extend(n, {
                        success: function(t, n, u) {
                            e.isFunction(o) && o(t, n, u), r.html(t), e(r).foundation("section", "reflow"), s.hide(i, s.settings.css.close), s.show(r, s.settings.css.open)
                        }
                    }), e.ajax(n)
                }
            }
        },
        close: function(t) {
            var t = t && t.length ? t : e(this.scope),
                n = e(".reveal-modal.open");
            n.length > 0 && (this.locked = !0, t.trigger("close"), this.toggle_bg(t), this.hide(n, this.settings.css.close))
        },
        close_targets: function() {
            var e = "." + this.settings.dismissModalClass;
            return this.settings.closeOnBackgroundClick ? e + ", ." + this.settings.bgClass : e
        },
        toggle_bg: function(t) {
            e(".reveal-modal-bg").length === 0 && (this.settings.bg = e("<div />", {
                "class": this.settings.bgClass
            }).appendTo("body")), this.settings.bg.filter(":visible").length > 0 ? this.hide(this.settings.bg) : this.show(this.settings.bg)
        },
        show: function(n, r) {
            if (r) {
                if (/pop/i.test(this.settings.animation)) {
                    r.top = e(t).scrollTop() - n.data("offset") + "px";
                    var i = {
                        top: e(t).scrollTop() + n.data("css-top") + "px",
                        opacity: 1
                    };
                    return this.delay(function() {
                        return n.css(r).animate(i, this.settings.animationSpeed, "linear", function() {
                            this.locked = !1, n.trigger("opened")
                        }.bind(this)).addClass("open")
                    }.bind(this), this.settings.animationSpeed / 2)
                }
                if (/fade/i.test(this.settings.animation)) {
                    var i = {
                        opacity: 1
                    };
                    return this.delay(function() {
                        return n.css(r).animate(i, this.settings.animationSpeed, "linear", function() {
                            this.locked = !1, n.trigger("opened")
                        }.bind(this)).addClass("open")
                    }.bind(this), this.settings.animationSpeed / 2)
                }
                return n.css(r).show().css({
                    opacity: 1
                }).addClass("open").trigger("opened")
            }
            return /fade/i.test(this.settings.animation) ? n.fadeIn(this.settings.animationSpeed / 2) : n.show()
        },
        hide: function(n, r) {
            if (r) {
                if (/pop/i.test(this.settings.animation)) {
                    var i = {
                        top: -e(t).scrollTop() - n.data("offset") + "px",
                        opacity: 0
                    };
                    return this.delay(function() {
                        return n.animate(i, this.settings.animationSpeed, "linear", function() {
                            this.locked = !1, n.css(r).trigger("closed")
                        }.bind(this)).removeClass("open")
                    }.bind(this), this.settings.animationSpeed / 2)
                }
                if (/fade/i.test(this.settings.animation)) {
                    var i = {
                        opacity: 0
                    };
                    return this.delay(function() {
                        return n.animate(i, this.settings.animationSpeed, "linear", function() {
                            this.locked = !1, n.css(r).trigger("closed")
                        }.bind(this)).removeClass("open")
                    }.bind(this), this.settings.animationSpeed / 2)
                }
                return n.hide().css(r).removeClass("open").trigger("closed")
            }
            return /fade/i.test(this.settings.animation) ? n.fadeOut(this.settings.animationSpeed / 2) : n.hide()
        },
        close_video: function(t) {
            var n = e(this).find(".flex-video"),
                r = n.find("iframe");
            r.length > 0 && (r.attr("data-src", r[0].src), r.attr("src", "about:blank"), n.hide())
        },
        open_video: function(t) {
            var n = e(this).find(".flex-video"),
                i = n.find("iframe");
            if (i.length > 0) {
                var s = i.attr("data-src");
                if (typeof s == "string") i[0].src = i.attr("data-src");
                else {
                    var o = i[0].src;
                    i[0].src = r, i[0].src = o
                }
                n.show()
            }
        },
        cache_offset: function(e) {
            var t = e.show().height() + parseInt(e.css("top"), 10);
            return e.hide(), t
        },
        off: function() {
            e(this.scope).off(".fndtn.reveal")
        },
        reflow: function() {}
    }
}(Foundation.zj, this, this.document),
function(e, t, n, r) {
    "use strict";
    Foundation.libs.section = {
        name: "section",
        version: "4.2.0",
        settings: {
            deep_linking: !1,
            one_up: !0,
            section_selector: "[data-section]",
            region_selector: "section, .section, [data-section-region]",
            title_selector: ".title, [data-section-title]",
            active_region_selector: "section.active, .section.active, .active[data-section-region]",
            content_selector: ".content, [data-section-content]",
            nav_selector: '[data-section="vertical-nav"], [data-section="horizontal-nav"]',
            callback: function() {}
        },
        init: function(t, n, r) {
            var i = this;
            return Foundation.inherit(this, "throttle data_options position_right offset_right"), typeof n == "object" && e.extend(!0, i.settings, n), typeof n != "string" ? (this.set_active_from_hash(), this.events(), !0) : this[n].call(this, r)
        },
        events: function() {
            var r = this;
            e(this.scope).on("click.fndtn.section", "[data-section] .title, [data-section] [data-section-title]", function(t) {
                var n = e(this),
                    i = n.closest(r.settings.region_selector);
                i.children(r.settings.content_selector).length > 0 && (r.toggle_active.call(this, t, r), r.reflow())
            }), e(t).on("resize.fndtn.section", r.throttle(function() {
                r.resize.call(this)
            }, 30)).on("hashchange", function() {
                r.settings.toggled || (r.set_active_from_hash(), e(this).trigger("resize"))
            }).trigger("resize"), e(n).on("click.fndtn.section", function(t) {
                e(t.target).closest(r.settings.title_selector).length < 1 && e(r.settings.nav_selector).children(r.settings.region_selector).removeClass("active").attr("style", "")
            })
        },
        toggle_active: function(t, n) {
            var r = e(this),
                n = Foundation.libs.section,
                i = r.closest(n.settings.region_selector),
                s = r.siblings(n.settings.content_selector),
                o = i.parent(),
                u = e.extend({}, n.settings, n.data_options(o)),
                a = o.children(n.settings.active_region_selector);
            n.settings.toggled = !0, !u.deep_linking && s.length > 0 && t.preventDefault();
            if (i.hasClass("active"))(n.small(o) || n.is_vertical_nav(o) || n.is_horizontal_nav(o) || n.is_accordion(o)) && (a[0] !== i[0] || a[0] === i[0] && !u.one_up) && i.removeClass("active").attr("style", "");
            else {
                var a = o.children(n.settings.active_region_selector),
                    f = n.outerHeight(i.children(n.settings.title_selector));
                if (n.small(o) || u.one_up) n.small(o) ? a.attr("style", "") : a.attr("style", "visibility: hidden; padding-top: " + f + "px;");
                n.small(o) ? i.attr("style", "") : i.css("padding-top", f), i.addClass("active"), a.length > 0 && a.removeClass("active").attr("style", ""), n.is_vertical_tabs(o) && (s.css("display", "block"), a !== null && a.children(n.settings.content_selector).css("display", "none"))
            }
            setTimeout(function() {
                n.settings.toggled = !1
            }, 300), u.callback()
        },
        resize: function() {
            var t = Foundation.libs.section,
                n = e(t.settings.section_selector);
            n.each(function() {
                var n = e(this),
                    r = n.children(t.settings.active_region_selector),
                    i = e.extend({}, t.settings, t.data_options(n));
                if (r.length > 1) r.not(":first").removeClass("active").attr("style", "");
                else if (r.length < 1 && !t.is_vertical_nav(n) && !t.is_horizontal_nav(n) && !t.is_accordion(n)) {
                    var s = n.children(t.settings.region_selector).first();
                    (i.one_up || !t.small(n)) && s.addClass("active"), t.small(n) ? s.attr("style", "") : s.css("padding-top", t.outerHeight(s.children(t.settings.title_selector)))
                }
                t.small(n) ? r.attr("style", "") : r.css("padding-top", t.outerHeight(r.children(t.settings.title_selector))), t.position_titles(n), t.is_horizontal_nav(n) && !t.small(n) || t.is_vertical_tabs(n) && !t.small(n) ? t.position_content(n) : t.position_content(n, !1)
            })
        },
        is_vertical_nav: function(e) {
            return /vertical-nav/i.test(e.data("section"))
        },
        is_horizontal_nav: function(e) {
            return /horizontal-nav/i.test(e.data("section"))
        },
        is_accordion: function(e) {
            return /accordion/i.test(e.data("section"))
        },
        is_horizontal_tabs: function(e) {
            return /^tabs$/i.test(e.data("section"))
        },
        is_vertical_tabs: function(e) {
            return /vertical-tabs/i.test(e.data("section"))
        },
        set_active_from_hash: function() {
            var n = t.location.hash.substring(1),
                r = e("[data-section]"),
                i = this;
            r.each(function() {
                var t = e(this),
                    r = e.extend({}, i.settings, i.data_options(t));
                if (n.length > 0 && r.deep_linking) {
                    var s = t.children(i.settings.region_selector).attr("style", "").removeClass("active"),
                        o = s.map(function() {
                            var t = e(i.settings.content_selector, this),
                                r = t.data("slug");
                            if ((new RegExp(r, "i")).test(n)) return t
                        }),
                        u = o.length;
                    for (var a = u - 1; a >= 0; a--) e(o[a]).parent().addClass("active")
                }
            })
        },
        position_titles: function(t, n) {
            var r = this,
                i = t.children(this.settings.region_selector).map(function() {
                    return e(this).children(r.settings.title_selector)
                }),
                s = 0,
                o = 0,
                r = this;
            typeof n == "boolean" ? i.attr("style", "") : i.each(function() {
                r.is_vertical_tabs(t) ? (e(this).css("top", o), o += r.outerHeight(e(this))) : (r.rtl ? e(this).css("right", s) : e(this).css("left", s), s += r.outerWidth(e(this)))
            })
        },
        position_content: function(t, n) {
            var r = this,
                i = t.children(r.settings.region_selector),
                s = i.map(function() {
                    return e(this).children(r.settings.title_selector)
                }),
                o = i.map(function() {
                    return e(this).children(r.settings.content_selector)
                });
            if (typeof n == "boolean") o.attr("style", ""), t.attr("style", "");
            else if (r.is_vertical_tabs(t) && !r.small(t)) {
                var u = 0,
                    a = Number.MAX_VALUE,
                    f = null;
                i.each(function() {
                    var n = e(this),
                        i = n.children(r.settings.title_selector),
                        s = n.children(r.settings.content_selector),
                        o = 0;
                    f = r.outerWidth(i), o = r.outerWidth(t) - f, o < a && (a = o), u += r.outerHeight(i), e(this).hasClass("active") || s.css("display", "none")
                }), i.each(function() {
                    var t = e(this).children(r.settings.content_selector);
                    t.css("minHeight", u), t.css("maxWidth", a - 2)
                })
            } else i.each(function() {
                var t = e(this),
                    n = t.children(r.settings.title_selector),
                    i = t.children(r.settings.content_selector);
                r.rtl ? i.css({
                    right: r.position_right(n) + 1,
                    top: r.outerHeight(n) - 2
                }) : i.css({
                    left: n.position().left - 1,
                    top: r.outerHeight(n) - 2
                })
            }), typeof Zepto == "function" ? t.height(this.outerHeight(e(s[0]))) : t.height(this.outerHeight(e(s[0])) - 2)
        },
        position_right: function(t) {
            var n = this,
                r = t.closest(this.settings.section_selector),
                i = r.children(this.settings.region_selector),
                s = t.closest(this.settings.section_selector).width(),
                o = i.map(function() {
                    return e(this).children(n.settings.title_selector)
                }).length;
            return s - t.position().left - t.width() * (t.index() + 1) - o
        },
        reflow: function(t) {
            var t = t || n;
            e(this.settings.section_selector, t).trigger("resize")
        },
        small: function(t) {
            var n = e.extend({}, this.settings, this.data_options(t));
            return this.is_horizontal_tabs(t) ? !1 : t && this.is_accordion(t) ? !0 : e("html").hasClass("lt-ie9") ? !0 : e("html").hasClass("ie8compat") ? !0 : e(this.scope).width() < 768
        },
        off: function() {
            e(this.scope).off(".fndtn.section"), e(t).off(".fndtn.section"), e(n).off(".fndtn.section")
        }
    }
}(Foundation.zj, this, this.document),
function(e, t, n, r) {
    "use strict";
    Foundation.libs.tooltips = {
        name: "tooltips",
        version: "4.2.0",
        settings: {
            selector: ".has-tip",
            additionalInheritableClasses: [],
            tooltipClass: ".tooltip",
            appendTo: "body",
            "disable-for-touch": !1,
            tipTemplate: function(e, t) {
                return '<span data-selector="' + e + '" class="' + Foundation.libs.tooltips.settings.tooltipClass.substring(1) + '">' + t + '<span class="nub"></span></span>'
            }
        },
        cache: {},
        init: function(t, n, r) {
            Foundation.inherit(this, "data_options");
            var i = this;
            typeof n == "object" ?
                e.extend(!0, this.settings, n) : typeof r != "undefined" && e.extend(!0, this.settings, r);
            if (typeof n == "string") return this[n].call(this, r);
            Modernizr.touch ? e(this.scope).on("click.fndtn.tooltip touchstart.fndtn.tooltip touchend.fndtn.tooltip", "[data-tooltip]", function(t) {
                var n = e.extend({}, i.settings, i.data_options(e(this)));
                n["disable-for-touch"] || (t.preventDefault(), e(n.tooltipClass).hide(), i.showOrCreateTip(e(this)))
            }).on("click.fndtn.tooltip touchstart.fndtn.tooltip touchend.fndtn.tooltip", this.settings.tooltipClass, function(t) {
                t.preventDefault(), e(this).fadeOut(150)
            }) : e(this.scope).on("mouseenter.fndtn.tooltip mouseleave.fndtn.tooltip", "[data-tooltip]", function(t) {
                var n = e(this);
                /enter|over/i.test(t.type) ? i.showOrCreateTip(n) : (t.type === "mouseout" || t.type === "mouseleave") && i.hide(n)
            })
        },
        showOrCreateTip: function(e) {
            var t = this.getTip(e);
            return t && t.length > 0 ? this.show(e) : this.create(e)
        },
        getTip: function(t) {
            var n = this.selector(t),
                r = null;
            return n && (r = e('span[data-selector="' + n + '"]' + this.settings.tooltipClass)), typeof r == "object" ? r : !1
        },
        selector: function(e) {
            var t = e.attr("id"),
                n = e.attr("data-tooltip") || e.attr("data-selector");
            return (t && t.length < 1 || !t) && typeof n != "string" && (n = "tooltip" + Math.random().toString(36).substring(7), e.attr("data-selector", n)), t && t.length > 0 ? t : n
        },
        create: function(t) {
            var n = e(this.settings.tipTemplate(this.selector(t), e("<div></div>").html(t.attr("title")).html())),
                r = this.inheritable_classes(t);
            n.addClass(r).appendTo(this.settings.appendTo), Modernizr.touch && n.append('<span class="tap-to-close">tap to close </span>'), t.removeAttr("title").attr("title", ""), this.show(t)
        },
        reposition: function(n, r, i) {
            var s, o, u, a, f, l;
            r.css("visibility", "hidden").show(), s = n.data("width"), o = r.children(".nub"), u = this.outerHeight(o), a = this.outerHeight(o), l = function(e, t, n, r, i, s) {
                return e.css({
                    top: t ? t : "auto",
                    bottom: r ? r : "auto",
                    left: i ? i : "auto",
                    right: n ? n : "auto",
                    width: s ? s : "auto"
                }).end()
            }, l(r, n.offset().top + this.outerHeight(n) + 10, "auto", "auto", n.offset().left, s);
            if (e(t).width() < 767) l(r, n.offset().top + this.outerHeight(n) + 10, "auto", "auto", 12.5, e(this.scope).width()), r.addClass("tip-override"), l(o, -u, "auto", "auto", n.offset().left);
            else {
                var c = n.offset().left;
                Foundation.rtl && (c = n.offset().left + n.offset().width - this.outerWidth(r)), l(r, n.offset().top + this.outerHeight(n) + 10, "auto", "auto", c, s), r.removeClass("tip-override"), i && i.indexOf("tip-top") > -1 ? l(r, n.offset().top - this.outerHeight(r), "auto", "auto", c, s).removeClass("tip-override") : i && i.indexOf("tip-left") > -1 ? l(r, n.offset().top + this.outerHeight(n) / 2 - u * 2.5, "auto", "auto", n.offset().left - this.outerWidth(r) - u, s).removeClass("tip-override") : i && i.indexOf("tip-right") > -1 && l(r, n.offset().top + this.outerHeight(n) / 2 - u * 2.5, "auto", "auto", n.offset().left + this.outerWidth(n) + u, s).removeClass("tip-override")
            }
            r.css("visibility", "visible").hide()
        },
        inheritable_classes: function(t) {
            var n = ["tip-top", "tip-left", "tip-bottom", "tip-right", "noradius"].concat(this.settings.additionalInheritableClasses),
                r = t.attr("class"),
                i = r ? e.map(r.split(" "), function(t, r) {
                    if (e.inArray(t, n) !== -1) return t
                }).join(" ") : "";
            return e.trim(i)
        },
        show: function(e) {
            var t = this.getTip(e);
            this.reposition(e, t, e.attr("class")), t.fadeIn(150)
        },
        hide: function(e) {
            var t = this.getTip(e);
            t.fadeOut(150)
        },
        reload: function() {
            var t = e(this);
            return t.data("fndtn-tooltips") ? t.foundationTooltips("destroy").foundationTooltips("init") : t.foundationTooltips("init")
        },
        off: function() {
            e(this.scope).off(".fndtn.tooltip"), e(this.settings.tooltipClass).each(function(t) {
                e("[data-tooltip]").get(t).attr("title", e(this).text())
            }).remove()
        },
        reflow: function() {}
    }
}(Foundation.zj, this, this.document),
function(e, t, n, r) {
    "use strict";
    Foundation.libs.topbar = {
        name: "topbar",
        version: "4.2.0",
        settings: {
            index: 0,
            stickyClass: "sticky",
            custom_back_text: !0,
            back_text: "Back",
            is_hover: !0,
            scrolltop: !0,
            init: !1
        },
        init: function(n, r, i) {
            Foundation.inherit(this, "data_options");
            var s = this;
            return typeof r == "object" ? e.extend(!0, this.settings, r) : typeof i != "undefined" && e.extend(!0, this.settings, i), typeof r != "string" ? (e(".top-bar, [data-topbar]").each(function() {
                e.extend(!0, s.settings, s.data_options(e(this))), s.settings.$w = e(t), s.settings.$topbar = e(this), s.settings.$section = s.settings.$topbar.find("section"), s.settings.$titlebar = s.settings.$topbar.children("ul").first(), s.settings.$topbar.data("index", 0);
                var n = e("<div class='top-bar-js-breakpoint'/>").insertAfter(s.settings.$topbar);
                s.settings.breakPoint = n.width(), n.remove(), s.assemble(), s.settings.$topbar.parent().hasClass("fixed") && e("body").css("padding-top", s.outerHeight(s.settings.$topbar))
            }), s.settings.init || this.events(), this.settings.init) : this[r].call(this, i)
        },
        events: function() {
            var n = this,
                r = this.outerHeight(e(".top-bar, [data-topbar]"));
            e(this.scope).off(".fndtn.topbar").on("click.fndtn.topbar", ".top-bar .toggle-topbar, [data-topbar] .toggle-topbar", function(i) {
                var s = e(this).closest(".top-bar, [data-topbar]"),
                    o = s.find("section, .section"),
                    u = s.children("ul").first();
                i.preventDefault(), n.breakpoint() && (n.rtl ? (o.css({
                    right: "0%"
                }), o.find(">.name").css({
                    right: "100%"
                })) : (o.css({
                    left: "0%"
                }), o.find(">.name").css({
                    left: "100%"
                })), o.find("li.moved").removeClass("moved"), s.data("index", 0), s.toggleClass("expanded").css("min-height", "")), s.hasClass("expanded") ? s.parent().hasClass("fixed") && (s.parent().removeClass("fixed"), s.addClass("fixed"), e("body").css("padding-top", "0"), n.settings.scrolltop && t.scrollTo(0, 0)) : s.hasClass("fixed") && (s.parent().addClass("fixed"), s.removeClass("fixed"), e("body").css("padding-top", r))
            }).on("mouseenter mouseleave", ".top-bar li", function(t) {
                if (!n.settings.is_hover) return;
                /enter|over/i.test(t.type) ? e(this).addClass("hover") : e(this).removeClass("hover")
            }).on("click.fndtn.topbar", ".top-bar li.has-dropdown", function(t) {
                if (n.breakpoint()) return;
                var r = e(this),
                    i = e(t.target),
                    s = r.closest("[data-topbar], .top-bar"),
                    o = s.data("topbar");
                if (n.settings.is_hover && !Modernizr.touch) return;
                t.stopImmediatePropagation(), i[0].nodeName === "A" && i.parent().hasClass("has-dropdown") && t.preventDefault(), r.hasClass("hover") ? r.removeClass("hover").find("li").removeClass("hover") : r.addClass("hover")
            }).on("click.fndtn.topbar", ".top-bar .has-dropdown>a, [data-topbar] .has-dropdown>a", function(t) {
                if (n.breakpoint()) {
                    t.preventDefault();
                    var r = e(this),
                        i = r.closest(".top-bar, [data-topbar]"),
                        s = i.find("section, .section"),
                        o = i.children("ul").first(),
                        u = r.next(".dropdown").outerHeight(),
                        a = r.closest("li");
                    i.data("index", i.data("index") + 1), a.addClass("moved"), n.rtl ? (s.css({
                        right: -(100 * i.data("index")) + "%"
                    }), s.find(">.name").css({
                        right: 100 * i.data("index") + "%"
                    })) : (s.css({
                        left: -(100 * i.data("index")) + "%"
                    }), s.find(">.name").css({
                        left: 100 * i.data("index") + "%"
                    })), i.css("min-height", n.height(r.siblings("ul")) + n.outerHeight(o, !0))
                }
            }), e(t).on("resize.fndtn.topbar", function() {
                n.breakpoint() || e(".top-bar, [data-topbar]").css("min-height", "").removeClass("expanded").find("li").removeClass("hover")
            }.bind(this)), e("body").on("click.fndtn.topbar", function(t) {
                var n = e(t.target).closest("[data-topbar], .top-bar");
                if (n.length > 0) return;
                e(".top-bar li, [data-topbar] li").removeClass("hover")
            }), e(this.scope).on("click.fndtn", ".top-bar .has-dropdown .back, [data-topbar] .has-dropdown .back", function(t) {
                t.preventDefault();
                var r = e(this),
                    i = r.closest(".top-bar, [data-topbar]"),
                    s = i.children("ul").first(),
                    o = i.find("section, .section"),
                    u = r.closest("li.moved"),
                    a = u.parent();
                i.data("index", i.data("index") - 1), n.rtl ? (o.css({
                    right: -(100 * i.data("index")) + "%"
                }), o.find(">.name").css({
                    right: 100 * i.data("index") + "%"
                })) : (o.css({
                    left: -(100 * i.data("index")) + "%"
                }), o.find(">.name").css({
                    left: 100 * i.data("index") + "%"
                })), i.data("index") === 0 ? i.css("min-height", 0) : i.css("min-height", n.height(a) + n.outerHeight(s, !0)), setTimeout(function() {
                    u.removeClass("moved")
                }, 300)
            })
        },
        breakpoint: function() {
            return e(t).width() <= this.settings.breakPoint || e("html").hasClass("lt-ie9")
        },
        assemble: function() {
            var t = this;
            this.settings.$section.detach(), this.settings.$section.find(".has-dropdown>a").each(function() {
                var n = e(this),
                    r = n.siblings(".dropdown"),
                    i = n.attr("href");
                if (i && i.length > 1) var s = e('<li class="title back js-generated"><h5><a href="#"></a></h5></li><li><a class="parent-link js-generated" href="' + i + '">' + n.text() + "</a></li>");
                else var s = e('<li class="title back js-generated"><h5><a href="#"></a></h5></li>');
                t.settings.custom_back_text == 1 ? s.find("h5>a").html("&laquo; " + t.settings.back_text) : s.find("h5>a").html("&laquo; " + n.html()), r.prepend(s)
            }), this.settings.$section.appendTo(this.settings.$topbar), this.sticky()
        },
        height: function(t) {
            var n = 0,
                r = this;
            return t.find("> li").each(function() {
                n += r.outerHeight(e(this), !0)
            }), n
        },
        sticky: function() {
            var n = "." + this.settings.stickyClass;
            if (e(n).length > 0) {
                var r = e(n).length ? e(n).offset().top : 0,
                    i = e(t),
                    s = this.outerHeight(e(".top-bar"));
                i.scroll(function() {
                    i.scrollTop() >= r ? (e(n).addClass("fixed"), e("body").css("padding-top", s)) : i.scrollTop() < r && (e(n).removeClass("fixed"), e("body").css("padding-top", "0"))
                })
            }
        },
        off: function() {
            e(this.scope).off(".fndtn.topbar"), e(t).off(".fndtn.topbar")
        },
        reflow: function() {}
    }
}(Foundation.zj, this, this.document),
function(e, t, n, r) {
    "use strict";
    Foundation.libs.interchange = {
        name: "interchange",
        version: "4.2.1",
        cache: {},
        settings: {
            load_attr: "interchange",
            named_queries: {
                "default": "only screen and (min-width: 1px)",
                small: "only screen and (min-width: 768px)",
                medium: "only screen and (min-width: 1280px)",
                large: "only screen and (min-width: 1440px)",
                landscape: "only screen and (orientation: landscape)",
                portrait: "only screen and (orientation: portrait)",
                retina: "only screen and (-webkit-min-device-pixel-ratio: 2),only screen and (min--moz-device-pixel-ratio: 2),only screen and (-o-min-device-pixel-ratio: 2/1),only screen and (min-device-pixel-ratio: 2),only screen and (min-resolution: 192dpi),only screen and (min-resolution: 2dppx)"
            },
            directives: {
                replace: function(e, t) {
                    if (/IMG/.test(e[0].nodeName)) {
                        var n = t.split("/"),
                            r = n[n.length - 1],
                            i = e[0].src;
                        if ((new RegExp(r, "i")).test(e[0].src)) return;
                        return e[0].src = t, e.trigger("replace", [e[0].src, i])
                    }
                }
            }
        },
        init: function(t, n, r) {
            return Foundation.inherit(this, "throttle"), typeof n == "object" && e.extend(!0, this.settings, n), this.events(), this.images(), typeof n != "string" ? this.settings.init : this[n].call(this, r)
        },
        events: function() {
            var n = this;
            e(t).on("resize.fndtn.interchange", n.throttle(function() {
                n.resize.call(n)
            }, 50))
        },
        resize: function() {
            var e = this.cache;
            for (var t in e)
                if (e.hasOwnProperty(t)) {
                    var n = this.results(t, e[t]);
                    n && this.settings.directives[n.scenario[1]](n.el, n.scenario[0])
                }
        },
        results: function(t, n) {
            var r = n.length,
                i = [];
            if (r > 0) {
                var s = e('[data-uuid="' + t + '"]');
                for (var o = r - 1; o >= 0; o--) {
                    var u = n[o][2];
                    if (this.settings.named_queries.hasOwnProperty(u)) var a = matchMedia(this.settings.named_queries[u]);
                    else var a = matchMedia(n[o][2]);
                    if (a.matches) return {
                        el: s,
                        scenario: n[o]
                    }
                }
            }
            return !1
        },
        images: function(e) {
            return typeof this.cached_images == "undefined" || e ? this.update_images() : this.cached_images
        },
        update_images: function() {
            var t = n.getElementsByTagName("img"),
                r = t.length,
                i = "data-" + this.settings.load_attr;
            this.cached_images = [];
            for (var s = r - 1; s >= 0; s--) this.loaded(e(t[s]), s === 0, function(e, t) {
                if (e) {
                    var n = e.getAttribute(i) || "";
                    n.length > 0 && this.cached_images.push(e)
                }
                t && this.enhance()
            }.bind(this));
            return "deferred"
        },
        loaded: function(e, t, n) {
            function r() {
                n(e[0], t)
            }

            function i() {
                this.one("load", r);
                if (/MSIE (\d+\.\d+);/.test(navigator.userAgent)) {
                    var e = this.attr("src"),
                        t = e.match(/\?/) ? "&" : "?";
                    t += "random=" + (new Date).getTime(), this.attr("src", e + t)
                }
            }
            if (!e.attr("src")) {
                r();
                return
            }
            e[0].complete || e[0].readyState === 4 ? r() : i.call(e)
        },
        enhance: function() {
            var n = this.images().length;
            for (var r = n - 1; r >= 0; r--) this._object(e(this.images()[r]));
            return e(t).trigger("resize")
        },
        parse_params: function(e, t, n) {
            return [this.trim(e), this.convert_directive(t), this.trim(n)]
        },
        convert_directive: function(e) {
            var t = this.trim(e);
            return t.length > 0 ? t : "replace"
        },
        _object: function(e) {
            var t = this.parse_data_attr(e),
                n = [],
                r = t.length;
            if (r > 0)
                for (var i = r - 1; i >= 0; i--) {
                    var s = t[i].split(/\((.*?)(\))$/);
                    if (s.length > 1) {
                        var o = s[0].split(","),
                            u = this.parse_params(o[0], o[1], s[1]);
                        n.push(u)
                    }
                }
            return this.store(e, n)
        },
        uuid: function(e) {
            function n() {
                return ((1 + Math.random()) * 65536 | 0).toString(16).substring(1)
            }
            var t = e || "-";
            return n() + n() + t + n() + t + n() + t + n() + t + n() + n() + n()
        },
        store: function(e, t) {
            var n = this.uuid(),
                r = e.data("uuid");
            return r ? this.cache[r] : (e.attr("data-uuid", n), this.cache[n] = t)
        },
        trim: function(t) {
            return typeof t == "string" ? e.trim(t) : t
        },
        parse_data_attr: function(e) {
            var t = e.data(this.settings.load_attr).split(/\[(.*?)\]/),
                n = t.length,
                r = [];
            for (var i = n - 1; i >= 0; i--) t[i].replace(/[\W\d]+/, "").length > 4 && r.push(t[i]);
            return r
        },
        reflow: function() {
            this.images(!0)
        }
    }
}(Foundation.zj, this, this.document);