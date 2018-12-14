var app = getApp();

Page({
    data: {
        color: "#459cf9",
        fwxy: !0
    },
    mdmfx: function() {
        this.setData({
            fwxy: !1
        });
    },
    yczz: function() {
        this.setData({
            fwxy: !0
        });
    },
    onLoad: function(t) {
        app.setNavigationBarColor(this);
        var a = this, n = wx.getStorageSync("users").id;
        this.setData({
            userinfo: wx.getStorageSync("users")
        }), app.util.request({
            url: "entry/wxapp/MySx",
            cachetime: "0",
            data: {
                user_id: n
            },
            success: function(t) {
                console.log(t.data), t.data ? a.setData({
                    yqr: t.data.name,
                    sxdata: t.data
                }) : a.setData({
                    yqr: "总店",
                    sxdata: t.data
                });
            }
        }), app.util.request({
            url: "entry/wxapp/MyCode",
            cachetime: "0",
            data: {
                user_id: n
            },
            success: function(t) {
                console.log(t.data), a.setData({
                    code: t.data
                });
            }
        });
    },
    distribution: function(t) {
        wx.navigateTo({
            url: "distribution"
        });
    },
    downline: function(t) {
        wx.navigateTo({
            url: "downline"
        });
    },
    ranking: function(t) {
        wx.navigateTo({
            url: "ranking"
        });
    },
    invation: function(t) {
        wx.navigateTo({
            url: "index"
        });
    },
    tixian: function(t) {
        wx.navigateTo({
            url: "tixian"
        });
    },
    onReady: function() {},
    onShow: function() {
        var a = this, t = wx.getStorageSync("users").id;
        app.util.request({
            url: "entry/wxapp/MyCommission",
            cachetime: "0",
            data: {
                user_id: t
            },
            success: function(t) {
                console.log(t.data), a.setData({
                    yjdata: t.data
                });
            }
        });
    },
    onHide: function() {},
    onUnload: function() {},
    onPullDownRefresh: function() {},
    onReachBottom: function() {},
    onShareAppMessage: function() {}
});