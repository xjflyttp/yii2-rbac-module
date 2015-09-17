var rbacRoleAssign = {
    urlGetAssign: null,
    urlGrant: null,
    urlRevoke: null,
    currentUser: null, //用户ID
    oUser: null,
    oInclude: null,
    oExclude: null,
    /**
     * 绑定click时间
     * @param {string} user #select id
     * @param {string} include #select id
     * @param {string} exclude #select id
     * @param {string} grantButton #button id
     * @param {string} revokeButton #button id
     * @returns {void}
     */
    bind: function(user, include, exclude, grantButton, revokeButton) {
        var _this = this;
        var oUser = this.oUser = $("#" + user);
        var oGrant = $("#" + grantButton);
        var oRevoke = $("#" + revokeButton);
        this.oInclude = $("#" + include);
        this.oExclude = $("#" + exclude);

        oUser.click(function() {
            _this.onUser(this);
        });
        oGrant.click(function() {
            _this.onGrant(this);
        });
        oRevoke.click(function() {
            _this.onRevoke(this);
        });
    },
    onUser: function(_this) {
        var selectUser = $(_this).val();
        if (typeof (selectUser) === "object") {
            if (selectUser.length > 0) {
                this.currentUser = selectUser = selectUser[0];
            } else {
                //no select
                return;
            }
        }
        console.log(selectUser);
        this.refreshColBC();
    },
    onGrant: function(_this) {
        var selected = this.oExclude.val();
        if (selected === null) {
            return;
        }
        if (selected.length === 0) {
            return;
        }
        $.ajax({
            async: false,
            type: "POST",
            url: this.urlGrant,
            data: {'roles': selected, 'uid': this.currentUser},
            success: function() {
            },
            dataType: 'text'
        });
        this.refreshColBC();
    },
    onRevoke: function(_this) {
        var selected = this.oInclude.val();
        if (selected === null) {
            return;
        }
        if (selected.length === 0) {
            return;
        }
        $.ajax({
            async: false,
            type: "POST",
            url: this.urlRevoke,
            data: {'roles': selected, 'uid': this.currentUser},
            success: function() {
            },
            dataType: 'text'
        });
        this.refreshColBC();
    },
    getAssignList: function(uid) {
        if (typeof (uid) === 'undefined') {
            var uid = this.currentUser;
        }
        var _assignList = {};
        $.ajax({
            cache: false,
            async: false,
            dataType: "json",
            url: this.urlGetAssign,
            data: {
                uid: uid
            },
            success: function(data) {
                _assignList = data;
            }
        });
        return _assignList;
    },
    /**
     * 刷新ColBC
     * @returns {undefined}
     */
    refreshColBC: function() {
        this.cleanColBC();

        var assignList = this.getAssignList();
        var unassignRoles = assignList.unassign;
        var assignRoles = assignList.assign;

        this.addDataToCol(this.oInclude, assignRoles);
        this.addDataToCol(this.oExclude, unassignRoles);

    },
    cleanColBC: function() {
        this.oInclude.html('');
        this.oExclude.html('');
    },
    addDataToCol: function(oCol, data) {
        $.each(data, function(key, val) {
            oCol.append($("<option></option>").attr("value", val).text(val));
        });
    }
};

var rbacPermAssign = {
    urlGetAssign: null,
    urlGrant: null,
    urlRevoke: null,
    currentRole: null, //角色名
    oRole: null,
    oInclude: null,
    oExclude: null,
    /**
     * 绑定click时间
     * @param {string} user #select id
     * @param {string} include #select id
     * @param {string} exclude #select id
     * @param {string} grantButton #button id
     * @param {string} revokeButton #button id
     * @returns {void}
     */
    bind: function(role, include, exclude, grantButton, revokeButton) {
        var _this = this;
        var oRole = this.oRole = $("#" + role);
        var oGrant = $("#" + grantButton);
        var oRevoke = $("#" + revokeButton);
        this.oInclude = $("#" + include);
        this.oExclude = $("#" + exclude);

        oRole.click(function() {
            _this.onRole(this);
        });
        oGrant.click(function() {
            _this.onGrant(this);
        });
        oRevoke.click(function() {
            _this.onRevoke(this);
        });
    },
    onRole: function(_this) {
        var selected = $(_this).val();
        if (typeof (selected) === "object") {
            if (selected.length > 0) {
                this.currentRole = selected = selected[0];
            } else {
                //no select
                return;
            }
        }
        console.log(this.currentRole);
        this.refreshColBC();
    },
    onGrant: function(_this) {
        var selected = this.oExclude.val();
        if (selected === null) {
            return;
        }
        if (selected.length === 0) {
            return;
        }
        $.ajax({
            async: false,
            type: "POST",
            url: this.urlGrant,
            data: {'perms': selected, 'role': this.currentRole},
            success: function() {
            },
            dataType: 'text'
        });
        this.refreshColBC();
    },
    onRevoke: function(_this) {
        var selected = this.oInclude.val();
        if (selected === null) {
            return;
        }
        if (selected.length === 0) {
            return;
        }
        $.ajax({
            async: false,
            type: "POST",
            url: this.urlRevoke,
            data: {'perms': selected, 'role': this.currentRole},
            success: function() {
            },
            dataType: 'text'
        });
        this.refreshColBC();
    },
    getAssignList: function(currentRole) {
        if (typeof (uid) === 'undefined') {
            var currentRole = this.currentRole;
        }
        var _assignList = {};
        $.ajax({
            cache: false,
            async: false,
            dataType: "json",
            url: this.urlGetAssign,
            data: {
                role: currentRole
            },
            success: function(data) {
                _assignList = data;
            }
        });
        return _assignList;
    },
    /**
     * 刷新ColBC
     * @returns {undefined}
     */
    refreshColBC: function() {
        this.cleanColBC();

        var assignList = this.getAssignList();
        var unassignRoles = assignList.unassign;
        var assignRoles = assignList.assign;

        this.addDataToCol(this.oInclude, assignRoles);
        this.addDataToCol(this.oExclude, unassignRoles);

    },
    cleanColBC: function() {
        this.oInclude.html('');
        this.oExclude.html('');
    },
    addDataToCol: function(oCol, data) {
        $.each(data, function(key, val) {
            oCol.append($("<option></option>").attr("value", val).text(val));
        });
    }
};
