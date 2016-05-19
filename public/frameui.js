function TrackFrameUI(newfrmbtn, framectr, player, kbDisabled) {
    var jobStart = player.job.start;
    var jobEnd = player.job.stop;
    var jobLen = jobEnd - jobStart;

    this.intervalsList = [];
    this.n = 0;

    var self = this;
    var frameStart = [];
    var frameEnd = [];

    this.setupUI = function(id) {
        framectr.append("<div class='bd-frm' id='bd-frm" + id + "'><div class='ctritem-frm'>" +
                            "<div class='button' id='startframe" + id + "' style='display: table-cell'>Set Start Frame</div>" +
                            "<div class='button' id='stopframe" + id + "' style='display: table-cell'>Set End Frame</div>" +
                            "<div class='button' id='resetframe" + id + "' style='display: table-cell'>Reset</div>" +
                            "<div class='button' id='deleteframe" + id + "' style='display: table-cell'>Delete</div>" +
                        "</div>" +
                        "<div class='ctritem-frm'>" +
                            "<form>" +
                                "Label name: " +
                                "<input id='labelname-frm" + id + "' type='text' name='labelname-frm' value='Frame " + (id + 1) + "'>" +
                            "</form>" +
                        "</div>" +
                        "<div class='ctritem-frm' id='timeline-frm" + id + "'>" +
                            "<div>Timeline</div>" +
                            "<div id='slider-range" + id + "' class='ui-slider ui-slider-horizontal ui-widget ui-widget-content ui-corner-all'></div>" +
                        "</div></div>"
                       );
    };

    this.setupBtns = function(id) {
        $("#startframe" + id).click(function() {
            frameStart[id] = player.frame - jobStart;
            console.log("start" + id + ": " + frameStart[id]);
            $(this).button("option", "disabled", true);
            $("#stopframe" + id).button("option", "disabled", false);
        }).button({
            icons: {
                primary: "ui-icon-radio-on"
            }
        });

        $("#stopframe" + id).click(function() {
            frameEnd[id] = player.frame - jobStart;
            console.log("end" + id + ": " + frameEnd[id]);
            $(this).button("option", "disabled", true);
            $("#startframe" + id).button("option", "disabled", false);

            if (frameEnd[id] < frameStart[id]) {
                frameStart[id] = frameStart[id] ^ frameEnd[id];
                frameEnd[id] = frameStart[id] ^ frameEnd[id];
                frameStart[id] = frameStart[id] ^ frameEnd[id];
            }

            self.addInterval({startValue: frameStart[id], endValue: frameEnd[id]}, id);
            self.updateTimeline(id);
            player.updateFrameInfo(self.intervalsList[id], $("#labelname-frm" + id).val(), id);
        }).button({
            disabled: true,
            icons: {
                primary: "ui-icon-radio-off"
            }
        });

        $("#resetframe" + id).click(function() {
            self.reset(id);
        }).button({
            icons: {
                primary: "ui-icon-arrowrefresh-1-s"
            }
        });

        $("#deleteframe" + id).click(function() {
            self.deleteFrame(id);
        }).button({
            icons: {
                primary: "ui-icon-close"
            }
        });

        $("#labelname-frm" + id).focusin(function() {
            kbDisabled[0] = true;
            console.log("focus in");
        });

        $("#labelname-frm" + id).focusout(function() {
            kbDisabled[0] = false;
            var id = parseInt(this.id.slice("labelname-frm".length));
            player.updateFrameInfo(undefined, $("#labelname-frm" + id).val(), id);
            console.log("focus out");
        });
    };

    this.unbind = function(id) {
        $("#startframe" + id).unbind("click");
        $("#stopframe" + id).unbind("click");
        $("#resetframe" + id).unbind("click");
        $("#deleteframe" + id).unbind("click");
        $("#labelname-frm" + id).unbind("focusin");
        $("#labelname-frm" + id).unbind("focusout");
    };

    this.addInterval = function(interval, id) {
        this.intervalsList[id].push(interval);
        this.intervalsList[id] = merge(this.intervalsList[id]);
    }

    newfrmbtn.click(function() {
        self.setupUI(self.n);
        self.setupBtns(self.n);
        self.intervalsList.push([]);
        self.n++;
    }).button({
        disabled: false,
        icons: {
            primary: "ui-icon-plus"
        }
    });
/*
    this.insert = function(newInterval) {
        console.log("insert");
        var intervals = this.intervals;
        var l = [];
        var count = 0;

        while (count < intervals.length) {
            if (newInterval.startValue <= intervals[count].endValue) {
                if (newInterval.endValue >= intervals[count].startValue) {
                    newInterval.startValue = Math.min(intervals[count].startValue, newInterval.startValue);
                }
                break;
            }
            l.push(intervals[count]);
            count += 1;
        }

        l.push(newInterval);

        while (count < intervals.length) {
            if (newInterval.endValue < intervals[count].startValue) {
                break;
            }
            var lastIdx = l.length - 1;
            l[lastIdx].endValue = Math.max(intervals[count].endValue, l[lastIdx].endValue);
            count += 1;
        }

        while (count < intervals.length) {
            l.push(intervals[count]);
            count += 1;
        }
        for (i = 0; i < l.length; i++) {
            l[i].id = i + 1;
        }

        return l;
    }
*/

    var updateHandles = function(ui, customContent) {
        var range = ui.range;
        var content = $("<div style='left: -4px; position: absolute;'>" + range.startValue + "</div>" +
                        "<div style='right: -4px; position: absolute;'>" + range.endValue + "</div>");
        return content;
    };

    // http://www.jqueryscript.net/slider/jQuery-Plugin-For-Multi-range-jQuery-UI-Range-Slider.html
    this.updateTimeline = function(id) {
        console.log("updateTimeline");

        var intervals = this.intervalsList[id];
        var length = intervals.length;

        if (length === 0) return;

        for (i = 0; i < length; i++) {
            intervals[i].id = i + 1;
        }

        $("#slider-range" + id).remove();
        $("#timeline-frm" + id).append("<div id='slider-range" + id + "'></div>");
        $("#slider-range" + id).rangeSlider({
            min: 0,
            max: jobEnd - jobStart,
            ranges: intervals,
            rangeLabel: function(event, ui) {
                return ui.label.empty().append(updateHandles(ui, true));
            }
        });
    };

    this.reset = function(id) {
        console.log("reset " + id);

        this.intervalsList[id] = [];
        $("#slider-range" + id).remove();
        $("#timeline-frm" + id).append("<div id='slider-range" + id + "' class='ui-slider ui-slider-horizontal ui-widget ui-widget-content ui-corner-all'></div>");
	$("#startframe" + id).button("option", "disabled", false);
        $("#stopframe" + id).button("option", "disabled", true);
        player.resetFrameInfo(id);
    };

    this.deleteFrame = function(id) {
        // slider-range, timeline-frm, startframe, endframe, labelname-frm
        console.log("delete " + id);
        $("#bd-frm" + id).remove();
        this.unbind(id);

        for (i = id + 1; i < this.intervalsList.length; i++) {
            $("#slider-range" + i).attr("id", "slider-range" + (i - 1));
            $("#bd-frm" + i).attr("id", "bd-frm" + (i - 1));
            $("#timeline-frm" + i).attr("id", "timeline-frm" + (i - 1));
            $("#labelname-frm" + i).attr("id", "labelname-frm" + (i - 1));
            $("#startframe" + i).attr("id", "startframe" + (i - 1));
            $("#stopframe" + i).attr("id", "stopframe" + (i - 1));
            $("#resetframe" + i).attr("id", "resetframe" + (i - 1));
            $("#deleteframe" + i).attr("id", "deleteframe" + (i - 1));
            this.unbind(i - 1);
            this.setupBtns(i - 1);
        }

        frameStart.splice(id, 1);
        frameEnd.splice(id, 1);
        this.intervalsList.splice(id, 1);
        this.n--;
        player.removeFrameInfo(id)
    };

    this.saveData = function() {
        console.log("saving data from frameui");

        var labels = [];
        var names = [];

        for (i = 0; i < this.n; i++) {
            var labelName = $("#labelname-frm" + i).val();

            if (labelName === "") {
                alert("The label name should not be empty.");
                return false;
            }

            var serializedData = JSON.stringify(serialize(this.intervalsList[i], jobLen)); // a binary array of int

            labels.push(serializedData);
            names.push(labelName);
        }

        var jobid = player.job.jobid; // an int

        console.log('start');
        console.log(JSON.stringify(labels));
        console.log(JSON.stringify(names));
        console.log('end');
        var data = {
            label: JSON.stringify(labels),
            name: JSON.stringify(names),
            id: jobid,
            flag: 0
        };

        $.ajax({
            type: "POST",
            url: "http://10.234.26.35/data_server/dataServer.php",
            async: true,
            data: {video_data: data},
            success: function(data) {
                console.log("frameui data saved");
            },
            failure: function(errMsg) {
                alert(errMsg);
            }
        });

        return true;
    };

    this.loadData = function(player) {
        console.log("loading data to frameui");

        var labels, names;
        var jobid = player.job.jobid;

        var load = {
            id: jobid,
            flag: 0
        };

        $.ajax({
            type: "POST",
            url: "http://10.234.26.35/data_server/dataServer.php",
            async: true,
            data: {video_load: load},
            success: function(response) {
                var message = JSON.parse(response);

                names = message["label_name"].split(",");
                labels = message["labels"].split("],[").join("]#[").split("#");

                console.log("frame name");
                console.log(names);
                //console.log("frame labels");
                //console.log(labels);

                if (names.length === 1 && names[0] === "")
                    return;

                console.assert(names.length == labels.length);

                labels.forEach(function(label, idx) {
                    newfrmbtn.click();
                    self.intervalsList[idx] = deserialize(JSON.parse(label));
                    $("#labelname-frm" + idx).val(names[idx]);
                    self.updateTimeline(idx);
                    player.updateFrameInfo(self.intervalsList[idx], $("#labelname-frm" + idx).val(), idx);
                });

                console.log("data loaded");
            }
        });
    };

    this.loadData(player);
}

var serialize = function(intervals, jobLen) {
    var serializedData = Array.apply(null, Array(jobLen)).map(Number.prototype.valueOf, 0);

    intervals.forEach(function (interval, index) {
        var len = interval.endValue - interval.startValue + 1;
        serializedData.splice(interval.startValue, len);
        serializedData.splice.apply(serializedData, [interval.startValue, 0].concat(Array.apply(null, Array(len)).map(Number.prototype.valueOf, 1)));
    });

    return serializedData;
};

var deserialize = function(serializedData) {
    var intervals = [];

    var start, end, len, interval;
    var offset = 0;

    var filtered = serializedData.filter(function (element) {
        return (element !== 0 && element !== 1);
    });

    if (filtered.length !== 0) {
        alert("wrong data format");
        return [];
    }

    while (serializedData.length > 0) {
        start = serializedData.indexOf(1);

        if (start === -1) {
            break;
        }

        serializedData.splice(0, start);
        len = serializedData.indexOf(0);

        end = start + ((len === -1) ? serializedData.length : len) - 1;

        interval = {startValue: offset + start, endValue: offset + end};
        intervals.push(interval);

        if (len === -1) {
            break;
        }

        serializedData.splice(0, len);
        offset += end + 1;
    }

    return intervals;
};

// translated from http://jelices.blogspot.com/2014/06/leetcode-python-merge-intervals.html
var merge = function(intervals) {
    intervals = mergeSort(intervals);
    var i = 1;
    while (i < intervals.length) {
        if (intervals[i-1].endValue >= intervals[i].startValue) {
            intervals[i-1].endValue = Math.max(intervals[i-1].endValue, intervals[i].endValue);
            intervals.splice(i, 1);
        }
        else {
            i += 1;
        }
    }

    return intervals;
};

var mergeSort = function(intervals) {
    if (intervals.length <= 1) {
        return intervals;
    }

    var left = mergeSort(intervals.slice(0, intervals.length/2));
    var right = mergeSort(intervals.slice(intervals.length/2, intervals.length));
    return mergeList(left, right);
};

var mergeList = function(list1, list2) {
    var solution = [];
    var pointer1 = 0;
    var pointer2 = 0;

    while (pointer1 < list1.length && pointer2 < list2.length) {
        if (list1[pointer1].startValue < list2[pointer2].startValue) {
            solution.push(list1[pointer1]);
            pointer1 += 1;
        }
        else {
            solution.push(list2[pointer2]);
            pointer2 += 1;
        }
    }

    while (pointer1 < list1.length) {
        solution.push(list1[pointer1]);
        pointer1 += 1;
    }

    while (pointer2 < list2.length) {
        solution.push(list2[pointer2]);
        pointer2 += 1;
    }

    return solution;
};
