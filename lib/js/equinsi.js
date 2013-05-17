/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

EQ = {
    errormsg: "",
    messages: "",
    pages: "",
    CPU: "",
    OVR: "",
    ajaxProcessor: {
        process: [],
        requests: [],
        responses: [],
        feedbacks: [],
        pid: 0,
        curProcess: "",
        makeProcess: function(o) {
            if (o.name && o.process) {
                if (this.process[o.name] != o.process)
                    this.process[o.name] = o.process;
                this.requests[o.name] = [];
                this.responses[o.name] = [];
                this.feedbacks[o.name] = [];
            }
        },
        startProcess: function(pname) {
            if (this.curProcess == "")
                this.sendRequests(pname);
        },
        newRequest: function(o) {
            this.requests[o.process][this.pid] = new EQ.ajaxProcess({
                url: o.url,
                parameters: o.parameters,
                pid: this.pid,
                process: o.process,
                feedback: o.feedback
            });
            this.pid++;
        },
        sendRequests: function(pname) {
            var r = this.requests[pname];
            var i;
            for (i in r) {
                if (r[i].state == "pauzed") {
                    r[i].start();
                    //console.log("starting procesrequest for "+pname+" id::"+i);
                }
            }
        },
        saveResponse: function(response, pid, process) {
            this.responses[process][pid] = response;
            this.doAction(response, this.feedbacks[process][pid], process);
            //controleer of alle requests van het process zijn afgelopen en uitgevoerd, dan naar volgende proces springen..
        },
        saveFeedback: function(feedback, pid, process) {
            this.feedbacks[process][pid] = feedback;
        },
        getResponse: function(pid, process) {
            return this.responses[process][pid];
        },
        doAction: function(response, feedback, pname) {
            if (this.process[pname](response, feedback))
                return true;
            else
                return false;
        }
    },
    ajaxProcess: function(o) {
        this.GetXmlHttpObject = function() {
            if (window.XMLHttpRequest) {
                // code for IE7+, Firefox, Chrome, Opera, Safari
                return new XMLHttpRequest();
            }
            if (window.ActiveXObject) {
                // code for IE6, IE5
                return new ActiveXObject("Microsoft.XMLHTTP");
            }
            return null;
        };
        this.secured = o.secured || false;
        this.parameters = o.parameters || false;
        this.feedback = o.feedback || "none";
        this.url = o.url || false;
        this.pid = o.pid || 0;
        this.process = o.process || "";
        this.state = "pauzed";
        this.ready = false;
        this.xhr = this.GetXmlHttpObject();
        this.check = function() {
            if (this.xhr == null) {
                alert("Jouw browser ondersteund geen ajaxrequests, download mozilla firefox op http://getfirefox.com om veiliger en sneller te surfen!");
                return false;
            } else
                return true;
        };
        this.start = function() {
            if (this.check()) {
                this.state = "started";
                this.xhr.open("POST", this.url, true);
                //objectvariabellen in het xmlhttprequest object steken (binnen onreadystate zijn we die kwijt!)
                this.xhr.pid = this.pid;
                this.xhr.process = this.process;
                this.xhr.feedback = this.feedback;
                this.xhr.po = this;
                this.xhr.onreadystatechange = function() {
                    this.po.state = this.readyState;
                    if (this.readyState == 4) {
                        if (this.status == 200) {
                            this.po.state = "finished";
                            this.po.ready = true;
                            EQ.CPU.saveFeedback(this.feedback, this.pid, this.process);
                            EQ.CPU.saveResponse(this.responseText, this.pid, this.process);
                        }
                        else {
                            this.po.state = this.xhr.status;
                            this.po.ready = true;
                        }
                    }
                }
                this.xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
                //this.xhr.setRequestHeader("Content-length", this.parameters.length);
                //this.xhr.setRequestHeader("Connection", "close");
                if (this.parameters) {
                    var extra = "";
                    if (localStorage && localStorage.getItem("uid")) {
                        extra = "&uid=" + localStorage.getItem("uid") + "&pin=" + localStorage.getItem("pin");
                    }
                    this.xhr.send(this.parameters + extra);
                }
                else
                    this.xhr.send();
            } else {
                this.state = "ofail";
                this.ready = true;
            }
        }
    },
    change: function(div) {
        for (var i = 0; i < this.pages.length; i++) {
            $("#" + this.pages[i]).hide();
            $("#" + this.pages[i] + "-but").removeClass("selected");
        }
        $("#" + div + "-but").addClass("selected");
        $("#" + div).fadeIn(200);
    },
    formCheckDate: function() {
        // http://www.the-art-of-web.com/javascript/validate-date/#.UZV79sqbpI8
        /*
         var allowBlank = false;
         var field = form.datum;
         var minYear = 1902;
         var maxYear = (new Date()).getFullYear();
         var errorMsg ="";
         re = /^(\d{1,2})\/(\d{1,2})\/(\d{4})$/; 
         if(field.value != '') { 
         if(regs = field.value.match(re)) { 
         if(regs[1] < 1 || regs[1] > 31) { 
         errorMsg = "Invalid value for day: " + regs[1]; } 
         else if(regs[2] < 1 || regs[2] > 12) { 
         errorMsg = "Invalid value for month: " + regs[2]; } 
         else if(regs[3] < minYear || regs[3] > maxYear) { 
         errorMsg = "Invalid value for year: " + regs[3] + " - must be between " + minYear + " and " + maxYear; } } 
         else { errorMsg = "Invalid date format: " + field.value; } } 
         else if(!allowBlank) { errorMsg = "Empty date not allowed!"; } 
         if(errorMsg != "") { 
         alert(errorMsg); field.focus(); return false; 
         } return true; 
         */
        form.datum.focus();
        alert("gelukt");
    },
    formCheck: function(elem, l, ml, email, pref) {
        var prefix = pref || "";
        var b = true;
        var elemn = elem.name;
        if (elemn != "submit")
            elem = elem.value.toString();
        else
            elem = 0;
        this.errormsg = "buzy";
        if (email == true) {
            if (!elem.match(/^([A-Za-z0-9_\-\.])+\@([A-Za-z0-9_\-\.])+\.([A-Za-z]{2,4})$/)) {
                this.errormsg = "form-match";
                b = false;
            }
        }
        if (l != "x") {
            if (elem.length < l) {
                this.errormsg = "form-length-short";
                b = false;
            }
        }
        if (ml != "x") {
            if (elem.length > ml) {
                this.errormsg = "form-length-max";
                b = false;
            }
        }
        if (!b) {
            $("#" + pref + "submit").html(EQ.messages['form-uncomplete']).addClass('wrong');
            $("#" + pref + elemn).html(EQ.messages[this.errormsg]).addClass('wrong');
        } else if (elemn != "submit") {
            this.errormsg = "form-complete";
            $("#" + pref + elemn).html(EQ.messages[this.errormsg]).removeClass('wrong').addClass('succes');
        }
        return b;
    },
    radioValue: function(radio) {
        var size = radio.length;
        for (i = 0; i < size; i++) {
            if (radio[i].checked)
                return radio[i].value;
        }
        ;
        return null;
    },
    getUid: function() {
        if (localStorage) {
            return localStorage.getItem("uid");
        } else
            return "";
    },
    jsp: function(j) {
        return jQuery.parseJSON(j);
    },
    login: function(json) {
        if (json.uid && json.pin) {
            if (localStorage) {
                localStorage.setItem("uid", json.uid);
                localStorage.setItem("pin", json.pin);
                return true;
            } else
                alert("Geen ondersteuning voor localstorage. U kan niet aanmelden!");
            return false;
        } else
            return false;
    },
    overflow: function(o) {
        this.title = o.t || o.title || "";
        this.sub = o.s || o.sub || "";
        this.head = o.head || o.h || "<hgroup><h3>" + this.title + "</h3><h7>" + this.sub + "</h7></hgroup>";
        this.content = o.c || o.content || "";
        this.footer = o.footer || o.f || "";
        this.button = o.button || "<a class='RoundedButton2' tabIndex='2' onclick='EQ.OVR.close();'><img src='/listel_new/lib/images/Close.png' title='sluiten' alt=''/></a>";
        this.attached = false;
        this.clickevent = function() {
            EQ.OVR.close();
        }
        this.attach = function(o) {
            this.attached = o;
            this.head = this.attached.h;
            this.content = this.attached.c;
            return this;
        };
        this.center = function(Xwidth, Yheight, divid, maxout) {
            //scroll berekenen
            var scrolledX, scrolledY;
            if (self.pageYOffset) {
                scrolledX = self.pageXOffset;
                scrolledY = self.pageYOffset;
            } else if (document.documentElement && document.documentElement.scrollTop) {
                scrolledX = document.documentElement.scrollLeft;
                scrolledY = document.documentElement.scrollTop;
            } else if (document.body) {
                scrolledX = document.body.scrollLeft;
                scrolledY = document.body.scrollTop;
            }
            //centre berekenen
            var centerX, centerY;
            if (self.innerHeight) {
                centerX = self.innerWidth;
                centerY = self.innerHeight;
            } else if (document.documentElement && document.documentElement.clientHeight) {
                centerX = document.documentElement.clientWidth;
                centerY = document.documentElement.clientHeight;
            } else if (document.body) {
                centerX = document.body.clientWidth;
                centerY = document.body.clientHeight;
            }
            //setup maxWidth and maxHeight
            if (maxout) {
                var b = Xwidth >= centerX || Yheight >= 600 ? true : false;
                Xwidth = Xwidth >= centerX ? (centerX - 10) : Xwidth;
                Yheight = Yheight >= (centerY * 0.9) ? (centerY * 0.9) : Yheight;
            }
            // Xwidth is the width of the div, Yheight is the height of the
            // div passed as arguments to the function:
            var leftOffset = scrolledX + ((centerX - Xwidth) / 2);
            var topOffset = scrolledY + ((centerY - Yheight) / 2);
            // The initial width and height of the div can be set in the
            // style sheet with display:none; divid is passed as an argument to // the function
            var o = document.getElementById(divid);
            var r = o.style;
            r.top = topOffset + 'px';
            r.left = leftOffset + 'px';

            if (maxout) {
                r.widht = Xwidth + 'px';
                r.height = Yheight + 'px';
                if (b)
                    r.overflow = "auto";
            }
            if (Yheight > centerY) {
                r.height = centerY + "px";
                r.top = scrolledY + "px";
                r.overflow = "auto";
            }
            if (Xwidth > centerX) {
                r.widht = centerX + "px";
                r.overflow = "auto";
            }
            return this;
        };
        this.open = function() {
            document.body.style.overflow = "hidden";
            $("#overflowbox").show();
            $("#overflow").on("click", EQ.OVR.clickevent);
            $("#vrflheader").html(this.head);
            $("#vrflcontent").html(this.content);
            $("#overflowcontent footer").html(this.footer + this.button);
            //$("#overflowcontent").height(document.documentElement.clientHeight+"px").width(document.documentElement.clientWidth+"px");
            this.center(document.documentElement.clientWidth, document.documentElement.clientHeight, "overflowcontent");
            $("#overflowcontent").show();
            return this;
        };
        this.close = function() {
            document.body.style.overflow = "visible";
            $("#oveflowcontent").hide();
            $("#overflowbox").hide();
            $("#overflow").off("click", EQ.OVR.clickevent);
            this.attached = false;
            return this;
        };
        this.refresh = function(a) {
            switch (a) {
                case "head":
                case "h":
                case"header":
                    if (this.attached)
                        this.head = this.attached.h;
                    else
                        this.head = "<hgroup><h3>" + this.title + "</h3><h7>" + this.sub + "</h7></hgroup>";
                    $("#vrflheader").html(this.head);
                    break;
                default:
                case "content":
                case "c":
                    if (this.attached)
                        this.content = this.attached.c;
                    $("#vrflcontent").html(this.content);
                    break;
                case "footer":
                case "f":
                    $("#overflowcontent footer").html(this.footer + this.button);
                    break;
            }
            return this;
        };
    }, reRoute: function(url, gofast, extra) {
        var xtra = extra || "";
        switch (url) {
            case "home":
                url = "/listel_new/ecareplan/home/welkom/";
                break;
            case "login":
                url = "/listel_new/ecareplan/login/login/";
                break;
            case "eid":
                url = "/listel_new/ecareplan/login/eid/";
                break;

            case "omb":
                url = "/listel_new/ecareplan/omb/";
                break;
            case "ombbewerk":
                url = "/listel_new/ecareplan/omb/bewerk/";
                break;
            case "ombnieuw":
                url = "/listel_new/ecareplan/omb/nieuw/";
                break;

            case "overleg":
                url = "/listel_new/ecareplan/overleg/toon/";
                break;
            case "overlegbewerk":
                url = "/listel_new/ecareplan/overleg/bewerk/";
                break;
            case "overlegnieuw":
                url = "/listel_new/ecareplan/overleg/nieuw/";
                break;
            default:
                break;
        }
        url += xtra + EQ.getUid();
        var time = gofast === true ? 0 : 3000;
        setTimeout(function() {
            window.location = url;
        }, time);
    }
};