function buildPlayerInfoUrl(realm, playerId)
{
    var playerInfoUrl = player_inspect_url + '?realm=' + realm + '&player_id=' + playerId;
    return playerInfoUrl;
}

function updatePlayerInfoTable(data)
{
    if (data.count < 1)
    {
        $('#player_infos_table').hide();
        $('.btn.btn-primary').addClass('disabled');
        return;
    }

    $('#player_infos tr').remove();
    $('#player_infos_table').show();

    var isNewVersion = $("select[name=realm]").size();
    var realm = isNewVersion ? $("select[name=realm]").val() : $("select[name=server]").val()

    var allOk = true;
    var validIds = '';
    var validNames = '';
    data.infos.forEach(function(item) {
        var rowClass = 'success';
        var id = item.obj_id;
        var name = item.player_name;
        var className = '';
        var level = '';
        var vipLevel = '';
        var isOnline = '';

        var status = '正常';

        if (item.error == 'not_found')
        {
            allOk = false;
            status = '<span class="label label-important">无此玩家</span>';
            rowClass = 'error';
        }
        else if (item.error == 'duplicated')
        {
            allOk = false;
            status = '<span class="label label-warning">重复输入的玩家</span>';
            rowClass = 'warning';
        }
        else
        {
            validIds += id + "    ";
            validNames += item.player_name + "    ";

            if (item.is_online)
            {
                var url = buildPlayerInfoUrl(realm, id);
                id = '<a href="' + url + '" target="new">' + id + '</a>'
                name = '<a href="' + url + '" target="new">' + item.player_name + '</a>'
            }

            className = item.class_name;
            level = item.level;
            vipLevel = item.vip_level;
            status = item.is_online ? '<span class="label label-success">在线</span>' : '<span class="label">离线</span>';
        }

        $('#player_infos').append(
            '<tr>' +
            '<td>' + id + '</td>' +
            '<td>' + name + '</td>' +
            '<td>' + className + '</td>' +
            '<td>' + level + '</td>' +
            '<td>' + vipLevel + '</td>' +
            '<td>' + status + '</td>' +
            '</tr>');
    });

    if (allOk)
    {
        $("#player_ids").val(validIds);
        $("#player_names").val(validNames);

        $('#player_infos').append(
            '<tr class="success">' +
            '<td colspan="6"><strong>输入的所有玩家都正确，可以提交</strong></td>' +
            '</tr>');

        $("#player_ids").closest('.control-group').removeClass('error').addClass('success');
    }
    else
    {
        $('#player_infos').append(
            '<tr class="error">' +
            '<td colspan="6"><strong>输入的玩家列表有问题，请检查修正后再提交</strong></td>' +
            '</tr>');

        $("#player_ids").closest('.control-group').removeClass('success').addClass('error');
    }

    $(document).data('_user_info_checker.all_ok', allOk);
}

function checkAndGetData(tab)
{
    var data;
    var realm = $("select[name=realm]").val();

    if (tab == 'via_id')
    {
        var ids = $("#player_ids").val().trim();
        if (ids == "")
        {
            $('#player_infos_table').hide();
            return null;
        }

        data = {
            ids: ids,
            realm: realm,
        };
    }
    else
    {
        var names = $("#player_names").val().trim();
        if (names == "")
        {
            $('#player_infos_table').hide();
            return null;
        }

        data = {
            names: names,
            realm: realm,
        };
    }

    return data;
}

$(document).ready(function() {
    $("#player_ids, #player_names").keyup(function() {
        $(document).data('_user_info_checker.all_ok', false);
    });

    $("#btn_check_player_info").click(function() {
        var tab = $('.info_tabs.active').data('tab');

        $("#player_ids").siblings('label.error').hide();
        $("#user_info_checker_container").siblings('label.error').hide();

        var data = checkAndGetData(tab);

        // 数据有效
        if (data != null)
        {
            var api_url = (tab == 'via_id') ? get_names_by_ids_api_url : get_ids_by_names_api_url;

            $.ajax({
                url: api_url,
                data: data,
                dataType: "json",
                success: function(data) {
                    updatePlayerInfoTable(data);
                },
                error: function(arg) {
                    var e = arg;
                }
            });
        }
    });
});

$.validator.addMethod("user_info_valid", function(value, element) {
    return $(document).data('_user_info_checker.all_ok');
}, "请先点击“检查玩家”按钮确认玩家信息无误后再提交");

