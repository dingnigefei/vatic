var uiDisabled = 0;
var kbDisabled = [false];

function ui_build(job)
{
    console.log(job);
    var fps = 10;
    var screen = ui_setup(job, fps);
    //var videoframe_fs = $("#videoframe-fs");
    //var videoframe_rgb = $("#videoframe-rgb");
    var videoframe_d = $("#videoframe-d");
    var player = new VideoPlayer(job, 10, videoframe_d);
    var tracks = new TrackCollection(player, job);
    var objectui = new TrackObjectUI($("#newobjbtn"), $("#objectcontainer"), videoframe_d, job, player, tracks, kbDisabled);
    var frameui = new TrackFrameUI($("#newfrmbtn"), $("#ctr-frm"), player, kbDisabled);

    ui_setupbuttons(job, player, tracks);
    ui_setupslider(player);
    ui_setupsubmit(frameui, objectui);
    ui_setupclickskip(job, player, tracks, objectui);
    ui_setupkeyboardshortcuts(job, player);
    // ui_loadprevious(job, objectui);

    $("#newobjbtn").click(function() {
        if (!mturk_submitallowed())
        {
            $("#turkic_acceptfirst").effect("pulsate");
        }
    });
}

function ui_setup(job, fps)
{
    var screen = $("<div id='annotatescreen' style='display: table'></div>").appendTo(container);

    $("<div id='divleftcol'>" +
          "<div id='instructions'>" +
              "<div style='display: table-cell; vertical-align: middle; padding-right: 10px'><div id='instructionsbutton' class='button'>Instructions</div></div>" +
              "<div id='instructions' style='display: table-cell; vertical-align: middle; padding-right: 10px'>You can annotate any object, or even the frame itself.</div>" +
          "</div>" +
          "<div id='videoframes'>" +
              //"<div class='videoframe' id='videoframe-fs'></div>" +
              //"<div class='videoframe' id='videoframe-rgb'></div>" +
              "<div class='videoframe' id='videoframe-d'></div>" +
          "</div>" +
          "<div id='bottombar'></div>" +
          "<div id='advancedoptions'></div>" +
      "</div>" +
      "<div id='divrightcol'>" +
          "<div class='ctrpanel'>" +
              "<div class='header'>" +
                  "<div style='display: table-cell; vertical-align: middle'><p>Label frame</p></div>" +
                  "<div class='button' id='newfrmbtn'>New Frame Label</div>" +
              "</div>" +
              "<div id='ctr-frm'></div>" +
          "</div>" +
          "<div class='ctrpanel'>" +
              "<div class='header'>" +
                  "<div style='display: table-cell; vertical-align: middle'><p>Label object</p></div>" +
                  "<div class='button' id='newobjbtn'>New Object</div>" +
              "</div>" +
              "<div id='ctr-obj'></div>" +
          "</div>" +
          "<div id='submitbar'></div>" +
      "</div>").appendTo(screen);

    var playerwidth = Math.max(320, job.width);

    $(".videoframe").css({"width": job.width + "px",
                          "height": job.height + "px",
                          "margin": "0 auto"})
                    .parent().css("width", playerwidth*3 + "px");

    $("#bottombar").append("<div id='playerslider'></div>");
    $("#bottombar").append("<div class='button' id='rewindbutton'>Rewind</div> ");
    $("#bottombar").append("<div class='button' id='playbutton'>Play</div> ");
    $("#bottombar").append("<div class='button' id='jumpbbutton'>Jump Backward</div> ");
    $("#bottombar").append("<div class='button' id='jumpfbutton'>Jump Forward</div> ");
    $("#bottombar").append("<div class='button' id='stepbbutton'>Step Backward</div> ");
    $("#bottombar").append("<div class='button' id='stepfbutton'>Step Forward</div> ");

    //$("#topbar").append("<div id='newobjectcontainer>" +
	//"<div class='button' id='startannotation'>Start</div></div>");

    $("<div id='objectcontainer'></div>").appendTo("#ctr-obj");

    $("<div class='button' id='openadvancedoptions'>Options</div>")
        .button({
            icons: {
                primary: "ui-icon-wrench"
            }
        }).appendTo($("#advancedoptions").parent()).click(function() {
            if ($("#advancedoptions").is(":visible") == true) {
                eventlog("options", "Hide advanced options");
                $("#advancedoptions").hide();
            }
            else {
		eventlog("options", "Show advanced options");
                //$(this).remove();
                $("#advancedoptions").show();
            }
        });

    $("#advancedoptions").hide();

    $("#advancedoptions").append(
    "<input type='checkbox' id='annotateoptionsresize'>" +
    "<label for='annotateoptionsresize'>Disable Resize?</label> " +
    "<input type='checkbox' id='annotateoptionshideboxes'>" +
    "<label for='annotateoptionshideboxes'>Hide Boxes?</label> " +
    "<input type='checkbox' id='annotateoptionshideboxtext'>" +
    "<label for='annotateoptionshideboxtext'>Hide Labels?</label> ");

    $("#advancedoptions").append(
    "<div id='speedcontrol'>" +
    "<input type='radio' name='speedcontrol' " +
        "value='" + Math.round(fps*0.25) + ",1' id='speedcontrolslower'>" +
    "<label for='speedcontrolslower'>Slower</label>" +
    "<input type='radio' name='speedcontrol' " +
        "value='" + Math.round(fps*0.5) + ",1' id='speedcontrolslow'>" +
    "<label for='speedcontrolslow'>Slow</label>" +
    "<input type='radio' name='speedcontrol' " +
        "value='" + Math.round(fps) + ",1' id='speedcontrolnorm' checked='checked'>" +
    "<label for='speedcontrolnorm'>Normal</label>" +
    "<input type='radio' name='speedcontrol' " +
        "value='" + Math.round(fps*2) + ",1' id='speedcontrolfast'>" +
    "<label for='speedcontrolfast'>Fast</label>" +
    "</div>");

    $("#submitbar").append("<div id='submitbutton' class='button'>Submit HIT</div>");

    if (mturk_isoffline())
    {
        $("#submitbutton").html("Save Work");
    }

    return screen;
}

function ui_setupbuttons(job, player, tracks)
{
    $("#instructionsbutton").click(function() {
        player.pause();
        ui_showinstructions(job);
    }).button({
        icons: {
            primary: "ui-icon-newwin"
        }
    });

    $("#playbutton").click(function() {
        if (!$(this).button("option", "disabled"))
        {
            player.toggle();

            if (player.paused)
            {
                eventlog("playpause", "Paused video");
            }
            else
            {
                eventlog("playpause", "Play video");
            }
        }
    }).button({
        disabled: false,
        icons: {
            primary: "ui-icon-play"
        }
    });

    $("#rewindbutton").click(function() {
        if (uiDisabled) return;
        player.pause();
        player.seek(player.job.start);
        eventlog("rewind", "Rewind to start");
    }).button({
        disabled: true,
        icons: {
            primary: "ui-icon-seek-first"
        }
    });

    $("#jumpbbutton").click(function() {
        var skip = job.skip > 0 ? -job.skip : -10;
        if (skip != 0)
        {
            player.pause();
            player.displace(skip);
            ui_snaptokeyframe(job, player);
        }
    }).button({
        disabled: false,
        icons: {
            primary: "ui-icon-seek-prev"
        }
    });

    $("#jumpfbutton").click(function() {
        var skip = job.skip > 0 ? job.skip : 10;
        if (skip != 0)
        {
            player.pause();
            player.displace(skip);
            ui_snaptokeyframe(job, player);
        }
   }).button({
        disabled: false,
        icons: {
            primary: "ui-icon-seek-next"
        }
    });

    $("#stepbbutton").click(function() {
        var skip = job.skip > 0 ? -job.skip : -1;
        if (skip != 0)
        {
            player.pause();
            player.displace(skip);
            ui_snaptokeyframe(job, player);
        }
    }).button({
        disabled: false,
        icons: {
            primary: "ui-icon-minus"
        }
    });

    $("#stepfbutton").click(function() {
        var skip = job.skip > 0 ? job.skip : 1;
        if (skip != 0)
        {
            player.pause();
            player.displace(skip);
            ui_snaptokeyframe(job, player);
        }
    }).button({
        disabled: false,
        icons: {
            primary: "ui-icon-plus"
        }
    });

    player.onplay.push(function() {
        $("#playbutton").button("option", {
            label: "Pause",
            icons: {
                primary: "ui-icon-pause"
            }
        });
    });

    player.onpause.push(function() {
        $("#playbutton").button("option", {
            label: "Play",
            icons: {
                primary: "ui-icon-play"
            }
        });
    });

    player.onupdate.push(function() {
        if (player.frame == player.job.stop)
        {
            $("#playbutton").button("option", "disabled", true);
        }
        else if ($("#playbutton").button("option", "disabled"))
        {
            $("#playbutton").button("option", "disabled", false);
        }

        if (player.frame == player.job.start)
        {
            $("#rewindbutton").button("option", "disabled", true);
        }
        else if ($("#rewindbutton").button("option", "disabled"))
        {
            $("#rewindbutton").button("option", "disabled", false);
        }
    });

    $("#speedcontrol").buttonset();
    $("input[name='speedcontrol']").click(function() {
        player.fps = parseInt($(this).val().split(",")[0]);
        player.playdelta = parseInt($(this).val().split(",")[1]);
        console.log("Change FPS to " + player.fps);
        console.log("Change play delta to " + player.playdelta);
        if (!player.paused)
        {
            player.pause();
            player.play();
        }
        eventlog("speedcontrol", "FPS = " + player.fps + " and delta = " + player.playdelta);
    });

    $("#annotateoptionsresize").button().click(function() {
        var resizable = $(this).attr("checked") ? false : true;
        tracks.resizable(resizable);

        if (resizable)
        {
            eventlog("disableresize", "Objects can be resized");
        }
        else
        {
            eventlog("disableresize", "Objects can not be resized");
        }
    });

    $("#annotateoptionshideboxes").button().click(function() {
        var visible = !$(this).attr("checked");
        tracks.visible(visible);

        if (visible)
        {
            eventlog("hideboxes", "Boxes are visible");
        }
        else
        {
            eventlog("hideboxes", "Boxes are invisible");
        }
    });

    $("#annotateoptionshideboxtext").button().click(function() {
        var visible = !$(this).attr("checked");

        if (visible)
        {
            $(".boundingboxtext").show();
        }
        else
        {
            $(".boundingboxtext").hide();
        }
    });
}

function ui_setupkeyboardshortcuts(job, player)
{
    $(window).keypress(function(e) {
        console.log("Key press: " + e.keyCode);

        if (uiDisabled)
        {
            console.log("Key press ignored because UI is disabled.");
            return;
        }

        if (kbDisabled[0]) {
            console.log("Keyboard disabled because user is typing.");
            return;
        }

        var keycode = e.keyCode ? e.keyCode : e.which;
        eventlog("keyboard", "Key press: " + keycode);

        if (keycode == 32 || keycode == 112 || keycode == 116 || keycode == 98)
        {
            $("#playbutton").click();
        }
        if (keycode == 114)
        {
            $("#rewindbutton").click();
        }
        else if (keycode == 78)
        {
            $("#newobjbtn").click();
        }
        else if (keycode == 77)
        {
            $("#newfrmbtn").click();
        }
        else if (keycode == 104)
        {
            $("#annotateoptionshideboxes").click();
        }
        else if (keycode == 68 || keycode == 100)
        {
            $("#jumpbbutton").click();
        }
        else if (keycode == 70 || keycode == 102)
        {
            $("#jumpfbutton").click();
        }
        else if (keycode == 67 || keycode == 99)
        {
            $("#stepbbutton").click();
        }
        else if (keycode == 86 || keycode == 118)
        {
            $("#stepfbutton").click();
        }
    });
}

function ui_canresize()
{
    return !$("#annotateoptionsresize").attr("checked");
}

function ui_areboxeshidden()
{
    return $("#annotateoptionshideboxes").attr("checked");
}

function ui_setupslider(player)
{
    var slider = $("#playerslider");
    slider.slider({
        range: "min",
        value: player.job.start,
        min: player.job.start,
        max: player.job.stop,
        slide: function(event, ui) {
            player.pause();
            player.seek(ui.value);
            // probably too much bandwidth
            //eventlog("slider", "Seek to " + ui.value);
            //console.log("slider", "Seek to " + ui.value);
        }
    });

    /*slider.children(".ui-slider-handle").hide();*/
    slider.children(".ui-slider-range").css({
        "background-color": "#868686",
        "background-image": "none"});

    slider.css({
        marginTop: "6px",
        width: parseInt(slider.parent().css("width")) - 200 + "px",
        float: "right"
    });

    player.onupdate.push(function() {
        slider.slider({value: player.frame});
    });
}

function ui_iskeyframe(frame, job)
{
    return frame == job.stop || (frame - job.start) % job.skip == 0;
}

function ui_snaptokeyframe(job, player)
{
    if (job.skip > 0 && !ui_iskeyframe(player.frame, job))
    {
        console.log("Fixing slider to key frame");
        var remainder = (player.frame - job.start) % job.skip;
        if (remainder > job.skip / 2)
        {
            player.seek(player.frame + (job.skip - remainder));
        }
        else
        {
            player.seek(player.frame - remainder);
        }
    }
}

function ui_setupclickskip(job, player, tracks, objectui)
{
    if (job.skip <= 0)
    {
        return;
    }

    player.onupdate.push(function() {
        if (ui_iskeyframe(player.frame, job))
        {
            console.log("Key frame hit");
            player.pause();
            $("#newobjbtn").button("option", "disabled", false);
            $("#playbutton").button("option", "disabled", false);
            tracks.draggable(true);
            tracks.resizable(ui_canresize());
            tracks.recordposition();
            objectui.enable();
        }
        else
        {
            $("#newobjbtn").button("option", "disabled", true);
            $("#playbutton").button("option", "disabled", true);
            tracks.draggable(false);
            tracks.resizable(false);
            objectui.disable();
        }
    });

    $("#playerslider").bind("slidestop", function() {
        ui_snaptokeyframe(job, player);
    });
}

function ui_loadprevious(job, objectui)
{
    var overlay = $('<div id="turkic_overlay"></div>').appendTo("#container");
    var note = $("<div id='submitdialog'>One moment...</div>").appendTo("#container");

    server_request("getboxesforjob", [job.jobid], function(data) {
        overlay.remove();
        note.remove();

        for (var i in data)
        {
            console.dir(data[i]["label"]);
            console.dir(data[i]["boxes"]);
            console.dir(data[i]["attributes"]);
            objectui.injectnewobject(data[i]["label"],
                                     data[i]["boxes"],
                                     data[i]["attributes"]);
        }
    });
}

function ui_setupsubmit(frameui, objectui)
{
    $("#submitbutton").button({
        icons: {
            primary: 'ui-icon-check'
        }
    }).click(function() {
        if (uiDisabled) return;
        uiDisabled = true
        var note = $("<div id='submitdialog'></div>").appendTo("#container");
        note.html("Saving...");
        if (!frameui.saveData()) return;
        if (!objectui.saveData()) return;
        note.html("Saved!");
        window.setTimeout(function() {
            note.remove();
            uiDisabled = false
        }, 1000);
        //ui_submit(objectui.job, objectui.tracks);
    });
}

function ui_submit(job, tracks)
{
    console.dir(tracks);
    console.log("Start submit - status: " + tracks.serialize());

    if (!mturk_submitallowed())
    {
        alert("Please accept the task before you submit.");
        return;
    }

    /*if (mturk_isassigned() && !mturk_isoffline())
    {
        if (!window.confirm("Are you sure you are ready to submit? Please " +
                            "make sure that the entire video is labeled and " +
                            "your annotations are tight.\n\nTo submit, " +
                            "press OK. Otherwise, press Cancel to keep " +
                            "working."))
        {
            return;
        }
    }*/

    var overlay = $('<div id="turkic_overlay"></div>').appendTo("#container");
    ui_disable();

    var note = $("<div id='submitdialog'></div>").appendTo("#container");

    function validatejob(callback)
    {
        server_post("validatejob", [job.jobid], tracks.serialize(),
            function(valid) {
                if (valid)
                {
                    console.log("Validation was successful");
                    callback();
                }
                else
                {
                    note.remove();
                    overlay.remove();
                    ui_enable();
                    console.log("Validation failed!");
                    ui_submit_failedvalidation();
                }
            });
    }

    function respawnjob(callback)
    {
        server_request("respawnjob", [job.jobid], function() {
            callback();
        });
    }

    function savejob(callback)
    {
        server_post("savejob", [job.jobid],
            tracks.serialize(), function(data) {
                callback()
            });
    }

    function finishsubmit(redirect)
    {
        if (mturk_isoffline())
        {
            window.setTimeout(function() {
                note.remove();
                overlay.remove();
                ui_enable();
            }, 1000);
        }
        else
        {
            window.setTimeout(function() {
                redirect();
            }, 1000);
        }
    }

    if (job.training)
    {
        console.log("Submit redirect to train validate");

        note.html("Checking...");
        validatejob(function() {
            savejob(function() {
                mturk_submit(function(redirect) {
                    respawnjob(function() {
                        note.html("Good work!");
                        finishsubmit(redirect);
                    });
                });
            });
        });
    }
    else
    {
        note.html("Saving...");
        savejob(function() {
            mturk_submit(function(redirect) {
                note.html("Saved!");
                finishsubmit(redirect);
            });
        });
    }
}

function ui_submit_failedvalidation()
{
    $('<div id="turkic_overlay"></div>').appendTo("#container");
    var h = $('<div id="failedverificationdialog"></div>')
    h.appendTo("#container");

    h.append("<h1>Low Quality Work</h1>");
    h.append("<p>Sorry, but your work is low quality. We would normally <strong>reject this assignment</strong>, but we are giving you the opportunity to correct your mistakes since you are a new user.</p>");

    h.append("<p>Please review the instructions, double check your annotations, and submit again. Remember:</p>");

    var str = "<ul>";
    str += "<li>You must label every object.</li>";
    str += "<li>You must draw your boxes as tightly as possible.</li>";
    str += "</ul>";

    h.append(str);

    h.append("<p>When you are ready to continue, press the button below.</p>");

    $('<div class="button" id="failedverificationbutton">Try Again</div>').appendTo(h).button({
        icons: {
            primary: "ui-icon-refresh"
        }
    }).click(function() {
        $("#turkic_overlay").remove();
        h.remove();
    }).wrap("<div style='text-align:center;padding:5x 0;' />");
}

function ui_showinstructions(job)
{
    console.log("Popup instructions");

    if ($("#instructionsdialog").size() > 0)
    {
        return;
    }

    eventlog("instructions", "Popup instructions");

    $('<div id="turkic_overlay"></div>').appendTo("#container");
    var h = $('<div id="instructionsdialog"></div>').appendTo("#container");

    $('<div class="button" id="instructionsclosetop">Dismiss Instructions</div>').appendTo(h).button({
        icons: {
            primary: "ui-icon-circle-close"
        }
    }).click(ui_closeinstructions);

    instructions(job, h);

    ui_disable();
}

function ui_closeinstructions()
{
    console.log("Popdown instructions");
    $("#turkic_overlay").remove();
    $("#instructionsdialog").remove();
    eventlog("instructions", "Popdown instructions");

    ui_enable();
}

function ui_disable()
{
    if (uiDisabled++ == 0)
    {
        $("#newfrmbtn").button("option", "disabled", true);
        $("#newobjbtn").button("option", "disabled", true);
        $("#playbutton").button("option", "disabled", true);
        $("#rewindbutton").button("option", "disabled", true);
        $("#jumpfbutton").button("option", "disabled", true);
        $("#jumpbbutton").button("option", "disabled", true);
        $("#stepfbutton").button("option", "disabled", true);
        $("#stepbdbutton").button("option", "disabled", true);
	$("#submitbutton").button("option", "disabled", true);
        $("#playerslider").slider("option", "disabled", true);

        console.log("Disengaged UI");
    }

    console.log("UI disabled with count = " + uiDisabled);
}

function ui_enable()
{
    if (--uiDisabled == 0)
    {
        $("#newfrmbtn").button("option", "disabled", false);
        $("#newobjbtn").button("option", "disabled", false);
        $("#playbutton").button("option", "disabled", false);
        $("#rewindbutton").button("option", "disabled", false);
	$("#jumpfbutton").button("option", "disabled", false);
        $("#jumpbbutton").button("option", "disabled", false);
        $("#stepfbutton").button("option", "disabled", false);
        $("#stepbdbutton").button("option", "disabled", false);
        $("#submitbutton").button("option", "disabled", false);
        $("#playerslider").slider("option", "disabled", false);

        console.log("Engaged UI");
    }

    uiDisabled = Math.max(0, uiDisabled);

    console.log("UI disabled with count = " + uiDisabled);
}
