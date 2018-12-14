var app = getApp();
Page({
    data: {
        group: "拼团开始",
        num: 3,
        button_text: "我要参团",
        sec: ""
    },
    onLoad: function(t) {
        var e = this;
        app.setNavigationBarColor(e), wx.setNavigationBarTitle({
            title: t.title
        }), app.getUserInfo(function(o) {
            console.log(o), e.setData({
                userInfo: o
            }), o.id == t.user_id ? e.setData({
                button_text: "邀请好友参团",
                button: "invite",
                button_type: "share"
            }) : e.setData({
                button_text: "我要参团",
                button: "join_group"
            })
        }), e.setData({
            id: t.id,
            options: t,
            goods_id: t.goods_id,
            num_peo: Number(t.group_num)
        }), e.refresh(), e.getCountDown(Number(t.time))
    },
    refresh: function(o) {
        var e = this,
            t = e.data.id;
        app.util.request({
            url: "entry/wxapp/GroupInfo",
            data: {
                group_id: t
            },
            success: function(o) {
                console.log(o), e.setData({
                    goods_info: o.data
                })
            }
        }), app.util.request({
            url: "entry/wxapp/GetGroupUserInfo",
            data: {
                group_id: t
            },
            success: function(o) {
                for (var t in console.log(o), o.data) e.data.userInfo.name == o.data[t].name && e.data.userInfo.id != e.data.options.user_id && e.setData({
                    button_text: "您已经参过团了",
                    button: "gfawgaw"
                });
                e.setData({
                    group_user: o.data
                })
            }
        })
    },
    getCountDown: function(a) {
        var s = this;
        "拼团开始" == s.data.group && setInterval(function() {
            var o = new Date,
                t = new Date(1e3 * a).getTime() - o.getTime(),
                e = Math.floor(t / 1e3 / 60 / 60) + "",
                n = Math.floor(t / 1e3 / 60 % 60) + "",
                i = Math.floor(t / 1e3 % 60) + "";
            0 < t ? (e < 10 && (e = "0" + e), n < 10 && (n = "0" + n), i < 10 && (i = "0" + i), e = e.split(""), n = n.split(""), i = i.split(""), s.setData({
                hour: e,
                min: n,
                sec: i
            })) : s.setData({
                group: "拼团已结束"
            })
        }, 1e3)
    },
    invite: function(o) {
        this.data
    },
    join_group: function(o) {
        var t = this.data;
        wx.navigateTo({
            url: "qgform?store_id=" + t.options.store_id + "&goods_id=" + t.goods_id + "&type=2&group_id=" + t.id + "&end_time=" + t.options.time + "&xf_time=" + t.options.xf_time
        })
    },
    onReady: function() {},
    onShow: function() {},
    onHide: function() {},
    onUnload: function() {},
    onPullDownRefresh: function() {},
    onReachBottom: function() {},
    onShareAppMessage: function() {
        var o = this.data;
        return {
            title: o.options.head_goup_name + "邀请您一起来拼团",
            path: "/zh_cjdianc/pages/collage/collageInfo?user_id=" + o.options.user_id + "&price=" + o.options.price + "&num=" + o.options.num + "&y_price=" + o.options.y_price + "&time=" + o.options.time + "&head_group_logo=" + o.options.head_group_logo + "&head_goup_name=" + o.options.head_goup_name + "&group_num=" + o.options.group_num + "&id=" + o.options.id + "&store_id=" + o.options.store_id + "&goods_id=" + o.options.goods_id,
            success: function(o) {
                console.log(o)
            },
            complete: function(o) {
                console.log("执行")
            }
        }
    }
});