/*
 * var videoplayer = VideoPlayer($("#frame"), 1000,
 *                   function (x) { return "/images/" + x + ".jpg"; });
 * videoplayer.play();
 */
function VideoPlayer(handle_fs, handle_rgb, handle_d, job, fps)
{
    var me = this;

    this.handle = handle_rgb;
    this.handle_fs = handle_fs;
    this.handle_d = handle_d;
    this.job = job;
    this.frame = job.start;
    this.paused = true;
    this.fps = fps;
    this.playdelta = 1;

    this.intervalsList = [];
    this.labelNameList = [];

    this.onplay = []; 
    this.onpause = []; 
    this.onupdate = [];

    this.handle.parent().after("<div id='frameinfo'>" + 
                                   "<div id='curframe'>Current frame: 0</div>" +
                                   "<div id='timer'>Elapsed time: 0 s</div>" +
                               "</div>");

    this.handle.append("<div id='frametag'></div>");

    /*
     * Toggles playing the video. If playing, pauses. If paused, plays.
     */
    this.toggle = function()
        {
            if (this.paused)
        {
            this.play();
        }
        else
        {
            this.pause();
        }
    }

    /*
     * Starts playing the video if paused.
     */
    this.play = function()
    {
        if (this.paused)
        {
            console.log("Playing...");
            this.paused = false;
            this.interval = window.setInterval(function() {
                if (me.frame >= me.job.stop)
                {
                    me.pause();
                }
                else
                {
                    me.displace(me.playdelta);
                }
            }, 1. / this.fps * 1000);

            this._callback(this.onplay);
        }
    }

    /*
     * Pauses the video if playing.
     */
    this.pause = function()
    {
        if (!this.paused)
        {
            console.log("Paused.");
            this.paused = true;
            window.clearInterval(this.interval);
            this.interval = null;

            this._callback(this.onpause);
        }
    }

    /*
     * Seeks to a specific video frame.
     */
    this.seek = function(target)
    {
        this.frame = target;
        this.updateframe();
    }

    /*
     * Displaces video frame by a delta.
     */
    this.displace = function(delta)
    {
        this.frame += delta;
        this.updateframe();
    }

    this.updateFrameInfo = function(intervals, labelName, id) {
        if (intervals !== undefined)
            this.intervalsList[id] = intervals;
        if (labelName !== undefined)
            this.labelNameList[id] = labelName;
    }

    this.resetFrameInfo = function(id) {
        this.intervalsList[id] = undefined;
        this.labelNameList[id] = undefined;
    }   

    this.removeFrameInfo = function(id) {
        this.intervalsList.splice(id, 1);
        this.labelNameList.splice(id, 1);
    }
 
    /*
     * Updates the current frame. Call whenever the frame changes.
     */
    this.updateframe = function()
    {
        this.frame = Math.min(this.frame, this.job.stop);
        this.frame = Math.max(this.frame, this.job.start);

        var url = this.job.frameurl(this.frame);
        this.handle.css("background-image", "url('" + url + "')");
        this.handle_fs.css("background-image", "url('" + url.replace('rgb', 'fs') + "')");
        this.handle_d.css("background-image", "url('" + url.replace('rgb', 'd') + "')");

        $("#curframe").replaceWith("<div id='curframe'>Current frame: " + (this.frame - job.start) + "</div>");
        $("#timer").replaceWith("<div id='timer'>Elapsed time: " + ((this.frame - job.start)/this.fps).toFixed(3) + " s</div>");
       
        $("#frametag").html("<div id='frametagtextbox'></div>");

        var curFrame = this.frame - this.job.start;

        for (i = 0; i < this.intervalsList.length; i++) {
            if (this.labelNameList[i] === undefined) {
                console.assert(this.intervalsList[i] === undefined);
                continue;
            }
            for (j = 0; j < this.intervalsList[i].length; j++) {
                if (curFrame >= this.intervalsList[i][j].startValue && curFrame <= this.intervalsList[i][j].endValue) {
                    $("#frametagtextbox").append("<div id='frametagtext'>" + this.labelNameList[i] + "</div>");
                    break;
                }
            }
        }

        if ($("#frametagtextbox").children().size() === 0) {
            $("#frametag").css("visibility", "hidden");
        } else {
            $("#frametag").css("visibility", "visible");
        }

        this._callback(this.onupdate);        
    }

    /*
     * Calls callbacks
     */
    this._callback = function(list)
    {
        for (var i = 0; i < list.length; i++)
        {
            list[i]();
        }
    }

    this.updateframe();
}
