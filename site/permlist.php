<?php

$perms="permid=4353 permname=b_serverinstance_help_view permdesc=Read\sServerQuery\shelp\sfiles|permid=4354 permname=b_serverinstance_version_view permdesc=Retrieve\sglobal\sserver\sversion|permid=4355 permname=b_serverinstance_info_view permdesc=Retrieve\sglobal\sserver\sinformation|permid=4356 permname=b_serverinstance_virtualserver_list permdesc=List\svirtual\sservers|permid=4357 permname=b_serverinstance_binding_list permdesc=List\sIP\sbindings|permid=4358 permname=b_serverinstance_permission_list permdesc=List\spermissions\savailable|permid=4359 permname=b_serverinstance_permission_find permdesc=Find\spermissions|permid=4616 permname=b_virtualserver_create permdesc=Create\svirtual\sservers|permid=4617 permname=b_virtualserver_delete permdesc=Delete\svirtual\sservers|permid=4618 permname=b_virtualserver_start_any permdesc=Start\sany\svirtual\sserver|permid=4619 permname=b_virtualserver_stop_any permdesc=Stop\sany\svirtual\sserver|permid=4620 permname=b_virtualserver_change_machine_id permdesc=Change\sa\svirtual\sservers\smachine\sID|permid=4877 permname=b_serverquery_login permdesc=Login\sto\sServerQuery|permid=4878 permname=b_serverinstance_textmessage_send permdesc=Send\stext\smessages\sto\sall\svirtual\sservers\sat\sonce|permid=4879 permname=b_serverinstance_log_view permdesc=Retrieve\sglobal\sserver\slog|permid=4880 permname=b_serverinstance_log_add permdesc=Write\sto\sglobal\sserver\slog|permid=4881 permname=b_serverinstance_stop permdesc=Shutdown\sthe\sserver\sprocess|permid=5138 permname=b_serverinstance_modify_settings permdesc=Edit\sglobal\ssettings|permid=5139 permname=b_serverinstance_modify_querygroup permdesc=Edit\sglobal\sServerQuery\sgroups|permid=5140 permname=b_serverinstance_modify_templates permdesc=Edit\sglobal\stemplate\sgroups|permid=8469 permname=b_virtualserver_select permdesc=Select\sa\svirtual\sserver|permid=8470 permname=b_virtualserver_info_view permdesc=Retrieve\svirtual\sserver\sinformation|permid=8471 permname=b_virtualserver_connectioninfo_view permdesc=Retrieve\svirtual\sserver\sconnection\sinformation|permid=8472 permname=b_virtualserver_channel_list permdesc=List\schannels\son\sa\svirtual\sserver|permid=8473 permname=b_virtualserver_channel_search permdesc=Search\sfor\schannels\son\sa\svirtual\sserver|permid=8474 permname=b_virtualserver_client_list permdesc=List\sclients\sonline\son\sa\svirtual\sserver|permid=8475 permname=b_virtualserver_client_search permdesc=Search\sfor\sclients\sonline\son\sa\svirtual\sserver|permid=8476 permname=b_virtualserver_client_dblist permdesc=List\sclient\sidentities\sknown\sby\sthe\svirtual\sserver|permid=8477 permname=b_virtualserver_client_dbsearch permdesc=Search\sfor\sclient\sidentities\sknown\sby\sthe\svirtual\sserver|permid=8478 permname=b_virtualserver_permission_find permdesc=Find\spermissions|permid=8479 permname=b_virtualserver_custom_search permdesc=Find\scustom\sfields|permid=8736 permname=b_virtualserver_start permdesc=Start\sown\svirtual\sserver|permid=8737 permname=b_virtualserver_stop permdesc=Stop\sown\svirtual\sserver|permid=8738 permname=b_virtualserver_token_list permdesc=List\stokens\savailable|permid=8739 permname=b_virtualserver_token_add permdesc=Create\snew\stokens|permid=8740 permname=b_virtualserver_token_use permdesc=Use\sa\stoken\sto\sgain\sprivileges|permid=8741 permname=b_virtualserver_token_delete permdesc=Delete\sa\stoken|permid=8742 permname=b_virtualserver_log_view permdesc=Retrieve\svirtual\sserver\slog|permid=8743 permname=b_virtualserver_log_add permdesc=Write\sto\svirtual\sserver\slog|permid=8744 permname=b_virtualserver_join_ignore_password permdesc=Join\svirtual\sserver\signoring\sits\spassword|permid=8745 permname=b_virtualserver_notify_register permdesc=Register\sfor\sserver\snotifications|permid=8746 permname=b_virtualserver_notify_unregister permdesc=Unregister\sfrom\sserver\snotifications|permid=8747 permname=b_virtualserver_snapshot_create permdesc=Create\sserver\ssnapshots|permid=8748 permname=b_virtualserver_snapshot_deploy permdesc=Deploy\sserver\ssnapshots|permid=8749 permname=b_virtualserver_permission_reset permdesc=Reset\syour\spermissions|permid=9006 permname=b_virtualserver_modify_name permdesc=Modify\sserver\sname|permid=9007 permname=b_virtualserver_modify_welcomemessage permdesc=Modify\swelcome\smessage|permid=9008 permname=b_virtualserver_modify_maxclients permdesc=Modify\sservers\smax\sclients|permid=9009 permname=b_virtualserver_modify_password permdesc=Modify\sserver\spassword|permid=9010 permname=b_virtualserver_modify_default_servergroup permdesc=Modify\sdefault\sServer\sGroup|permid=9011 permname=b_virtualserver_modify_default_channelgroup permdesc=Modify\sdefault\sChannel\sGroup|permid=9012 permname=b_virtualserver_modify_default_channeladmingroup permdesc=Modify\sdefault\sChannel\sAdmin\sGroup|permid=9013 permname=b_virtualserver_modify_channel_forced_silence permdesc=Modify\schannel\sforce\ssilence\svalue|permid=9014 permname=b_virtualserver_modify_complain permdesc=Modify\sindividual\scomplain\ssettings|permid=9015 permname=b_virtualserver_modify_antiflood permdesc=Modify\sindividual\santiflood\ssettings|permid=9016 permname=b_virtualserver_modify_ft_settings permdesc=Modify\sfile\stransfer\ssettings|permid=9017 permname=b_virtualserver_modify_ft_quotas permdesc=Modify\sfile\stransfer\squotas|permid=9018 permname=b_virtualserver_modify_hostmessage permdesc=Modify\sindividual\shostmessage\ssettings|permid=9019 permname=b_virtualserver_modify_hostbanner permdesc=Modify\sindividual\shostbanner\ssettings|permid=9020 permname=b_virtualserver_modify_hostbutton permdesc=Modify\sindividual\shostbutton\ssettings|permid=9021 permname=b_virtualserver_modify_port permdesc=Modify\sserver\sport|permid=9022 permname=b_virtualserver_modify_autostart permdesc=Modify\sserver\sautostart|permid=9023 permname=b_virtualserver_modify_needed_identity_security_level permdesc=Modify\srequired\sidentity\ssecurity\slevel|permid=9024 permname=b_virtualserver_modify_priority_speaker_dimm_modificator permdesc=Modify\spriority\sspeaker\sdimm\smodificator|permid=9025 permname=b_virtualserver_modify_log_settings permdesc=Modify\slog\ssettings|permid=9026 permname=b_virtualserver_modify_min_client_version permdesc=Modify\smin\sclient\sversion|permid=12355 permname=i_channel_min_depth permdesc=Min\schannel\screation\sdepth\sin\shierarchy|permid=12356 permname=i_channel_max_depth permdesc=Max\schannel\screation\sdepth\sin\shierarchy|permid=12357 permname=b_channel_group_inheritance_end permdesc=Stop\sinheritance\sof\sChannel\sGroup\spermissions|permid=12614 permname=b_channel_info_view permdesc=Retrieve\schannel\sinformation|permid=12871 permname=b_channel_create_child permdesc=Create\ssub-channels|permid=12872 permname=b_channel_create_permanent permdesc=Create\spermanent\schannels|permid=12873 permname=b_channel_create_semi_permanent permdesc=Create\ssemi-permanent\schannels|permid=12874 permname=b_channel_create_temporary permdesc=Create\stemporary\schannels|permid=12875 permname=b_channel_create_with_topic permdesc=Create\schannels\swith\sa\stopic|permid=12876 permname=b_channel_create_with_description permdesc=Create\schannels\swith\sa\sdescription|permid=12877 permname=b_channel_create_with_password permdesc=Create\spassword\sprotected\schannels|permid=12878 permname=b_channel_create_modify_with_codec_speex8 permdesc=Create\schannels\susing\sSpeex\sNarrowband\s(8\skHz)\scodecs|permid=12879 permname=b_channel_create_modify_with_codec_speex16 permdesc=Create\schannels\susing\sSpeex\sWideband\s(16\skHz)\scodecs|permid=12880 permname=b_channel_create_modify_with_codec_speex32 permdesc=Create\schannels\susing\sSpeex\sUltra-Wideband\s(32\skHz)\scodecs|permid=12881 permname=b_channel_create_modify_with_codec_celtmono48 permdesc=Create\schannels\susing\sthe\sCELT\sMono\s(48\skHz)\scodec\s|permid=12882 permname=i_channel_create_modify_with_codec_maxquality permdesc=Create\schannels\swith\scustom\scodec\squality|permid=12883 permname=b_channel_create_with_maxclients permdesc=Create\schannels\swith\scustom\smax\sclients|permid=12884 permname=b_channel_create_with_maxfamilyclients permdesc=Create\schannels\swith\scustom\smax\sfamily\sclients|permid=12885 permname=b_channel_create_with_sortorder permdesc=Create\schannels\swith\scustom\ssort\sorder|permid=12886 permname=b_channel_create_with_default permdesc=Create\sdefault\schannels|permid=12887 permname=b_channel_create_with_needed_talk_power permdesc=Create\schannels\swith\sneeded\stalk\spower|permid=13144 permname=b_channel_modify_parent permdesc=Move\schannels|permid=13145 permname=b_channel_modify_make_default permdesc=Make\schannel\sdefault|permid=13146 permname=b_channel_modify_make_permanent permdesc=Make\schannel\spermanent|permid=13147 permname=b_channel_modify_make_semi_permanent permdesc=Make\schannel\ssemi-permanent|permid=13148 permname=b_channel_modify_make_temporary permdesc=Make\schannel\stemporary|permid=13149 permname=b_channel_modify_name permdesc=Modify\schannel\sname|permid=13150 permname=b_channel_modify_topic permdesc=Modify\schannel\stopic|permid=13151 permname=b_channel_modify_description permdesc=Modify\schannel\sdescription|permid=13152 permname=b_channel_modify_password permdesc=Modify\schannel\spassword|permid=13153 permname=b_channel_modify_codec permdesc=Modify\schannel\scodec|permid=13154 permname=b_channel_modify_codec_quality permdesc=Modify\schannel\scodec\squality|permid=13155 permname=b_channel_modify_maxclients permdesc=Modify\schannels\smax\sclients|permid=13156 permname=b_channel_modify_maxfamilyclients permdesc=Modify\schannels\smax\sfamily\sclients|permid=13157 permname=b_channel_modify_sortorder permdesc=Modify\schannel\ssort\sorder|permid=13158 permname=b_channel_modify_needed_talk_power permdesc=Change\sneeded\schannel\stalk\spower|permid=13159 permname=i_channel_modify_power permdesc=Channel\smodify\spower|permid=13160 permname=i_channel_needed_modify_power permdesc=Needed\schannel\smodify\spower|permid=13417 permname=b_channel_delete_permanent permdesc=Delete\spermanent\schannels|permid=13418 permname=b_channel_delete_semi_permanent permdesc=Delete\ssemi-permanent\schannels|permid=13419 permname=b_channel_delete_temporary permdesc=Delete\stemporary\schannels|permid=13420 permname=b_channel_delete_flag_force permdesc=Force\schannel\sdelete|permid=13677 permname=b_channel_join_permanent permdesc=Join\spermanent\schannels|permid=13678 permname=b_channel_join_semi_permanent permdesc=Join\ssemi-permanent\schannels|permid=13679 permname=b_channel_join_temporary permdesc=Join\stemporary\schannels|permid=13680 permname=b_channel_join_ignore_password permdesc=Join\schannel\signoring\sits\spassword|permid=13681 permname=b_channel_join_ignore_maxclients permdesc=Ignore\schannels\smax\sclients\slimit|permid=13682 permname=i_channel_join_power permdesc=Channel\sjoin\spower|permid=13683 permname=i_channel_needed_join_power permdesc=Needed\schannel\sjoin\spower|permid=13684 permname=i_channel_subscribe_power permdesc=Channel\ssubscribe\spower|permid=13685 permname=i_channel_needed_subscribe_power permdesc=Needed\schannel\ssubscribe\spower|permid=16502 permname=i_group_icon_id permdesc=Group\sicon\sidentifier|permid=16503 permname=i_group_max_icon_filesize permdesc=Max\sicon\sfilesize\sin\sbytes|permid=16504 permname=b_group_icon_manage permdesc=Enables\sicon\smanagement|permid=16505 permname=b_group_is_permanent permdesc=Group\sis\spermanent|permid=16762 permname=b_virtualserver_servergroup_list permdesc=List\sserver\sgroups|permid=16763 permname=b_virtualserver_servergroup_permission_list permdesc=List\sserver\sgroup\spermissions|permid=16764 permname=b_virtualserver_servergroup_client_list permdesc=List\sclients\sfrom\sa\sserver\sgroup|permid=16765 permname=b_virtualserver_channelgroup_list permdesc=List\schannel\sgroups\s|permid=16766 permname=b_virtualserver_channelgroup_permission_list permdesc=List\schannel\sgroup\spermissions|permid=16767 permname=b_virtualserver_channelgroup_client_list permdesc=List\sclients\sfrom\sa\schannel\sgroup|permid=16768 permname=b_virtualserver_client_permission_list permdesc=List\sclient\spermissions|permid=16769 permname=b_virtualserver_channel_permission_list permdesc=List\schannel\spermissions|permid=16770 permname=b_virtualserver_channelclient_permission_list permdesc=List\schannel\sclient\spermissions|permid=17027 permname=b_virtualserver_servergroup_create permdesc=Create\sserver\sgroups|permid=17028 permname=b_virtualserver_channelgroup_create permdesc=Create\schannel\sgroups|permid=17285 permname=i_group_modify_power permdesc=Group\smodify\spower|permid=17286 permname=i_group_needed_modify_power permdesc=Needed\sgroup\smodify\spower|permid=17287 permname=i_group_member_add_power permdesc=Group\smember\sadd\spower|permid=17288 permname=i_group_needed_member_add_power permdesc=Needed\sgroup\smember\sadd\spower|permid=17289 permname=i_group_member_remove_power permdesc=Group\smember\sdelete\spower|permid=17290 permname=i_group_needed_member_remove_power permdesc=Needed\sgroup\smember\sdelete\spower|permid=17291 permname=i_permission_modify_power permdesc=Permission\smodify\spower|permid=17292 permname=b_permission_modify_power_ignore permdesc=Ignore\sneeded\spermission\smodify\spower|permid=17549 permname=b_virtualserver_servergroup_delete permdesc=Delete\sserver\sgroups|permid=17550 permname=b_virtualserver_channelgroup_delete permdesc=Delete\schannel\sgroups|permid=20623 permname=i_client_max_clones permdesc=Max\sadditional\sconnections\sper\sclient\sidentity|permid=20624 permname=i_client_max_idletime permdesc=Max\sidle\stime\sin\sseconds|permid=20625 permname=i_client_max_avatar_filesize permdesc=Max\savatar\sfilesize\sin\sbytes|permid=20626 permname=i_client_max_channel_subscriptions permdesc=Max\schannel\ssubscriptions|permid=20627 permname=b_client_is_priority_speaker permdesc=Client\sis\spriority\sspeaker|permid=20628 permname=b_client_skip_channelgroup_permissions permdesc=Ignore\schannel\sgroup\spermissions|permid=20629 permname=b_client_force_push_to_talk permdesc=Force\sPush-To-Talk\scapture\smode|permid=20630 permname=b_client_ignore_bans permdesc=Ignore\sbans|permid=20631 permname=b_client_ignore_antiflood permdesc=Ignore\santiflood\smeasurements|permid=20632 permname=b_client_issue_client_query_command permdesc=Issue\squery\scommands\sfrom\sclient|permid=20889 permname=b_client_info_view permdesc=Retrieve\sclient\sinformation|permid=20890 permname=b_client_permissionoverview_view permdesc=Retrieve\sclient\spermissions\soverview|permid=20891 permname=b_client_remoteaddress_view permdesc=View\sclient\sIP\saddress\sand\sport|permid=20892 permname=i_client_serverquery_view_power permdesc=ServerQuery\sview\spower|permid=20893 permname=i_client_needed_serverquery_view_power permdesc=Needed\sServerQuery\sview\spower|permid=20894 permname=b_client_custom_info_view permdesc=View\scustom\sfields|permid=21151 permname=i_client_kick_power permdesc=Client\skick\spower|permid=21152 permname=i_client_needed_kick_power permdesc=Needed\sclient\skick\spower|permid=21153 permname=i_client_ban_power permdesc=Client\sban\spower|permid=21154 permname=i_client_needed_ban_power permdesc=Needed\sclient\sban\spower|permid=21155 permname=i_client_move_power permdesc=Client\smove\spower|permid=21156 permname=i_client_needed_move_power permdesc=Needed\sclient\smove\spower|permid=21157 permname=i_client_complain_power permdesc=Complain\spower|permid=21158 permname=i_client_needed_complain_power permdesc=Needed\scomplain\spower|permid=21159 permname=b_client_complain_list permdesc=Show\scomplain\slist|permid=21160 permname=b_client_complain_delete_own permdesc=Delete\sown\scomplains|permid=21161 permname=b_client_complain_delete permdesc=Delete\scomplains|permid=21162 permname=b_client_ban_list permdesc=Show\sbanlist|permid=21163 permname=b_client_ban_create permdesc=Add\sa\sban|permid=21164 permname=b_client_ban_delete_own permdesc=Delete\sown\sbans|permid=21165 permname=b_client_ban_delete permdesc=Delete\sbans|permid=21166 permname=i_client_ban_max_bantime permdesc=Max\sbantime|permid=21423 permname=i_client_private_textmessage_power permdesc=Client\sprivate\smessage\spower|permid=21424 permname=i_client_needed_private_textmessage_power permdesc=Needed\sclient\sprivate\smessage\spower|permid=21425 permname=b_client_server_textmessage_send permdesc=Send\stext\smessages\sto\svirtual\sserver|permid=21426 permname=b_client_channel_textmessage_send permdesc=Send\stext\smessages\sto\schannel|permid=21427 permname=b_client_offline_textmessage_send permdesc=Send\soffline\smessages\sto\sclients|permid=21428 permname=i_client_talk_power permdesc=Client\stalk\spower|permid=21429 permname=i_client_needed_talk_power permdesc=Needed\sclient\stalk\spower|permid=21430 permname=i_client_poke_power permdesc=Client\spoke\spower|permid=21431 permname=i_client_needed_poke_power permdesc=Needed\sclient\spoke\spower|permid=21432 permname=b_client_set_flag_talker permdesc=Set\sthe\stalker\sflag\sfor\sclients\sand\sallow\sthem\sto\sspeak|permid=21689 permname=b_client_modify_description permdesc=Edit\sa\sclients\sdescription|permid=21690 permname=b_client_modify_dbproperties permdesc=Edit\sa\sclients\sproperties\sin\sthe\sdatabase|permid=21691 permname=b_client_delete_dbproperties permdesc=Delete\sa\sclients\sproperties\sin\sthe\sdatabase|permid=21692 permname=b_client_create_modify_serverquery_login permdesc=Create\sor\smodify\sown\sServerQuery\saccount|permid=24765 permname=b_ft_ignore_password permdesc=Browse\sfiles\swithout\schannel\spassword|permid=24766 permname=b_ft_transfer_list permdesc=Retrieve\slist\sof\srunning\sfiletransfers|permid=24767 permname=i_ft_file_upload_power permdesc=File\supload\spower|permid=24768 permname=i_ft_needed_file_upload_power permdesc=Needed\sfile\supload\spower|permid=24769 permname=i_ft_file_download_power permdesc=File\sdownload\spower|permid=24770 permname=i_ft_needed_file_download_power permdesc=Needed\sfile\sdownload\spower|permid=24771 permname=i_ft_file_delete_power permdesc=File\sdelete\spower|permid=24772 permname=i_ft_needed_file_delete_power permdesc=Needed\sfile\sdelete\spower|permid=24773 permname=i_ft_file_rename_power permdesc=File\srename\spower|permid=24774 permname=i_ft_needed_file_rename_power permdesc=Needed\sfile\srename\spower|permid=24775 permname=i_ft_file_browse_power permdesc=File\sbrowse\spower|permid=24776 permname=i_ft_needed_file_browse_power permdesc=Needed\sfile\sbrowse\spower|permid=24777 permname=i_ft_directory_create_power permdesc=Create\sdirectory\spower|permid=24778 permname=i_ft_needed_directory_create_power permdesc=Needed\screate\sdirectory\spower|permid=24779 permname=i_ft_quota_mb_download_per_client permdesc=Download\squota\sper\sclient\sin\sMByte|permid=24780 permname=i_ft_quota_mb_upload_per_client permdesc=Upload\squota\sper\sclient\sin\sMByte|permid=65281 permname=i_needed_modify_power_serverinstance_help_view permdesc|permid=65282 permname=i_needed_modify_power_serverinstance_version_view permdesc|permid=65283 permname=i_needed_modify_power_serverinstance_info_view permdesc|permid=65284 permname=i_needed_modify_power_serverinstance_virtualserver_list permdesc|permid=65285 permname=i_needed_modify_power_serverinstance_binding_list permdesc|permid=65286 permname=i_needed_modify_power_serverinstance_permission_list permdesc|permid=65287 permname=i_needed_modify_power_serverinstance_permission_find permdesc|permid=65288 permname=i_needed_modify_power_virtualserver_create permdesc|permid=65289 permname=i_needed_modify_power_virtualserver_delete permdesc|permid=65290 permname=i_needed_modify_power_virtualserver_start_any permdesc|permid=65291 permname=i_needed_modify_power_virtualserver_stop_any permdesc|permid=65292 permname=i_needed_modify_power_virtualserver_change_machine_id permdesc|permid=65293 permname=i_needed_modify_power_serverquery_login permdesc|permid=65294 permname=i_needed_modify_power_serverinstance_textmessage_send permdesc|permid=65295 permname=i_needed_modify_power_serverinstance_log_view permdesc|permid=65296 permname=i_needed_modify_power_serverinstance_log_add permdesc|permid=65297 permname=i_needed_modify_power_serverinstance_stop permdesc|permid=65298 permname=i_needed_modify_power_serverinstance_modify_settings permdesc|permid=65299 permname=i_needed_modify_power_serverinstance_modify_querygroup permdesc|permid=65300 permname=i_needed_modify_power_serverinstance_modify_templates permdesc|permid=65301 permname=i_needed_modify_power_virtualserver_select permdesc|permid=65302 permname=i_needed_modify_power_virtualserver_info_view permdesc|permid=65303 permname=i_needed_modify_power_virtualserver_connectioninfo_view permdesc|permid=65304 permname=i_needed_modify_power_virtualserver_channel_list permdesc|permid=65305 permname=i_needed_modify_power_virtualserver_channel_search permdesc|permid=65306 permname=i_needed_modify_power_virtualserver_client_list permdesc|permid=65307 permname=i_needed_modify_power_virtualserver_client_search permdesc|permid=65308 permname=i_needed_modify_power_virtualserver_client_dblist permdesc|permid=65309 permname=i_needed_modify_power_virtualserver_client_dbsearch permdesc|permid=65310 permname=i_needed_modify_power_virtualserver_permission_find permdesc|permid=65311 permname=i_needed_modify_power_virtualserver_custom_search permdesc|permid=65312 permname=i_needed_modify_power_virtualserver_start permdesc|permid=65313 permname=i_needed_modify_power_virtualserver_stop permdesc|permid=65314 permname=i_needed_modify_power_virtualserver_token_list permdesc|permid=65315 permname=i_needed_modify_power_virtualserver_token_add permdesc|permid=65316 permname=i_needed_modify_power_virtualserver_token_use permdesc|permid=65317 permname=i_needed_modify_power_virtualserver_token_delete permdesc|permid=65318 permname=i_needed_modify_power_virtualserver_log_view permdesc|permid=65319 permname=i_needed_modify_power_virtualserver_log_add permdesc|permid=65320 permname=i_needed_modify_power_virtualserver_join_ignore_password permdesc|permid=65321 permname=i_needed_modify_power_virtualserver_notify_register permdesc|permid=65322 permname=i_needed_modify_power_virtualserver_notify_unregister permdesc|permid=65323 permname=i_needed_modify_power_virtualserver_snapshot_create permdesc|permid=65324 permname=i_needed_modify_power_virtualserver_snapshot_deploy permdesc|permid=65325 permname=i_needed_modify_power_virtualserver_permission_reset permdesc|permid=65326 permname=i_needed_modify_power_virtualserver_modify_name permdesc|permid=65327 permname=i_needed_modify_power_virtualserver_modify_welcomemessage permdesc|permid=65328 permname=i_needed_modify_power_virtualserver_modify_maxclients permdesc|permid=65329 permname=i_needed_modify_power_virtualserver_modify_password permdesc|permid=65330 permname=i_needed_modify_power_virtualserver_modify_default_servergroup permdesc|permid=65331 permname=i_needed_modify_power_virtualserver_modify_default_channelgroup permdesc|permid=65332 permname=i_needed_modify_power_virtualserver_modify_default_channeladmingroup permdesc|permid=65333 permname=i_needed_modify_power_virtualserver_modify_channel_forced_silence permdesc|permid=65334 permname=i_needed_modify_power_virtualserver_modify_complain permdesc|permid=65335 permname=i_needed_modify_power_virtualserver_modify_antiflood permdesc|permid=65336 permname=i_needed_modify_power_virtualserver_modify_ft_settings permdesc|permid=65337 permname=i_needed_modify_power_virtualserver_modify_ft_quotas permdesc|permid=65338 permname=i_needed_modify_power_virtualserver_modify_hostmessage permdesc|permid=65339 permname=i_needed_modify_power_virtualserver_modify_hostbanner permdesc|permid=65340 permname=i_needed_modify_power_virtualserver_modify_hostbutton permdesc|permid=65341 permname=i_needed_modify_power_virtualserver_modify_port permdesc|permid=65342 permname=i_needed_modify_power_virtualserver_modify_autostart permdesc|permid=65343 permname=i_needed_modify_power_virtualserver_modify_needed_identity_security_level permdesc|permid=65344 permname=i_needed_modify_power_virtualserver_modify_priority_speaker_dimm_modificator permdesc|permid=65345 permname=i_needed_modify_power_virtualserver_modify_log_settings permdesc|permid=65346 permname=i_needed_modify_power_virtualserver_modify_min_client_version permdesc|permid=65347 permname=i_needed_modify_power_channel_min_depth permdesc|permid=65348 permname=i_needed_modify_power_channel_max_depth permdesc|permid=65349 permname=i_needed_modify_power_channel_group_inheritance_end permdesc|permid=65350 permname=i_needed_modify_power_channel_info_view permdesc|permid=65351 permname=i_needed_modify_power_channel_create_child permdesc|permid=65352 permname=i_needed_modify_power_channel_create_permanent permdesc|permid=65353 permname=i_needed_modify_power_channel_create_semi_permanent permdesc|permid=65354 permname=i_needed_modify_power_channel_create_temporary permdesc|permid=65355 permname=i_needed_modify_power_channel_create_with_topic permdesc|permid=65356 permname=i_needed_modify_power_channel_create_with_description permdesc|permid=65357 permname=i_needed_modify_power_channel_create_with_password permdesc|permid=65358 permname=i_needed_modify_power_channel_create_modify_with_codec_speex8 permdesc|permid=65359 permname=i_needed_modify_power_channel_create_modify_with_codec_speex16 permdesc|permid=65360 permname=i_needed_modify_power_channel_create_modify_with_codec_speex32 permdesc|permid=65361 permname=i_needed_modify_power_channel_create_modify_with_codec_celtmono48 permdesc|permid=65362 permname=i_needed_modify_power_channel_create_modify_with_codec_maxquality permdesc|permid=65363 permname=i_needed_modify_power_channel_create_with_maxclients permdesc|permid=65364 permname=i_needed_modify_power_channel_create_with_maxfamilyclients permdesc|permid=65365 permname=i_needed_modify_power_channel_create_with_sortorder permdesc|permid=65366 permname=i_needed_modify_power_channel_create_with_default permdesc|permid=65367 permname=i_needed_modify_power_channel_create_with_needed_talk_power permdesc|permid=65368 permname=i_needed_modify_power_channel_modify_parent permdesc|permid=65369 permname=i_needed_modify_power_channel_modify_make_default permdesc|permid=65370 permname=i_needed_modify_power_channel_modify_make_permanent permdesc|permid=65371 permname=i_needed_modify_power_channel_modify_make_semi_permanent permdesc|permid=65372 permname=i_needed_modify_power_channel_modify_make_temporary permdesc|permid=65373 permname=i_needed_modify_power_channel_modify_name permdesc|permid=65374 permname=i_needed_modify_power_channel_modify_topic permdesc|permid=65375 permname=i_needed_modify_power_channel_modify_description permdesc|permid=65376 permname=i_needed_modify_power_channel_modify_password permdesc|permid=65377 permname=i_needed_modify_power_channel_modify_codec permdesc|permid=65378 permname=i_needed_modify_power_channel_modify_codec_quality permdesc|permid=65379 permname=i_needed_modify_power_channel_modify_maxclients permdesc|permid=65380 permname=i_needed_modify_power_channel_modify_maxfamilyclients permdesc|permid=65381 permname=i_needed_modify_power_channel_modify_sortorder permdesc|permid=65382 permname=i_needed_modify_power_channel_modify_needed_talk_power permdesc|permid=65383 permname=i_needed_modify_power_channel_modify_power permdesc|permid=65384 permname=i_needed_modify_power_channel_needed_modify_power permdesc|permid=65385 permname=i_needed_modify_power_channel_delete_permanent permdesc|permid=65386 permname=i_needed_modify_power_channel_delete_semi_permanent permdesc|permid=65387 permname=i_needed_modify_power_channel_delete_temporary permdesc|permid=65388 permname=i_needed_modify_power_channel_delete_flag_force permdesc|permid=65389 permname=i_needed_modify_power_channel_join_permanent permdesc|permid=65390 permname=i_needed_modify_power_channel_join_semi_permanent permdesc|permid=65391 permname=i_needed_modify_power_channel_join_temporary permdesc|permid=65392 permname=i_needed_modify_power_channel_join_ignore_password permdesc|permid=65393 permname=i_needed_modify_power_channel_join_ignore_maxclients permdesc|permid=65394 permname=i_needed_modify_power_channel_join_power permdesc|permid=65395 permname=i_needed_modify_power_channel_needed_join_power permdesc|permid=65396 permname=i_needed_modify_power_channel_subscribe_power permdesc|permid=65397 permname=i_needed_modify_power_channel_needed_subscribe_power permdesc|permid=65398 permname=i_needed_modify_power_group_icon_id permdesc|permid=65399 permname=i_needed_modify_power_group_max_icon_filesize permdesc|permid=65400 permname=i_needed_modify_power_group_icon_manage permdesc|permid=65401 permname=i_needed_modify_power_group_is_permanent permdesc|permid=65402 permname=i_needed_modify_power_virtualserver_servergroup_list permdesc|permid=65403 permname=i_needed_modify_power_virtualserver_servergroup_permission_list permdesc|permid=65404 permname=i_needed_modify_power_virtualserver_servergroup_client_list permdesc|permid=65405 permname=i_needed_modify_power_virtualserver_channelgroup_list permdesc|permid=65406 permname=i_needed_modify_power_virtualserver_channelgroup_permission_list permdesc|permid=65407 permname=i_needed_modify_power_virtualserver_channelgroup_client_list permdesc|permid=65408 permname=i_needed_modify_power_virtualserver_client_permission_list permdesc|permid=65409 permname=i_needed_modify_power_virtualserver_channel_permission_list permdesc|permid=65410 permname=i_needed_modify_power_virtualserver_channelclient_permission_list permdesc|permid=65411 permname=i_needed_modify_power_virtualserver_servergroup_create permdesc|permid=65412 permname=i_needed_modify_power_virtualserver_channelgroup_create permdesc|permid=65413 permname=i_needed_modify_power_group_modify_power permdesc|permid=65414 permname=i_needed_modify_power_group_needed_modify_power permdesc|permid=65415 permname=i_needed_modify_power_group_member_add_power permdesc|permid=65416 permname=i_needed_modify_power_group_needed_member_add_power permdesc|permid=65417 permname=i_needed_modify_power_group_member_remove_power permdesc|permid=65418 permname=i_needed_modify_power_group_needed_member_remove_power permdesc|permid=65419 permname=i_needed_modify_power_permission_modify_power permdesc|permid=65420 permname=i_needed_modify_power_permission_modify_power_ignore permdesc|permid=65421 permname=i_needed_modify_power_virtualserver_servergroup_delete permdesc|permid=65422 permname=i_needed_modify_power_virtualserver_channelgroup_delete permdesc|permid=65423 permname=i_needed_modify_power_client_max_clones permdesc|permid=65424 permname=i_needed_modify_power_client_max_idletime permdesc|permid=65425 permname=i_needed_modify_power_client_max_avatar_filesize permdesc|permid=65426 permname=i_needed_modify_power_client_max_channel_subscriptions permdesc|permid=65427 permname=i_needed_modify_power_client_is_priority_speaker permdesc|permid=65428 permname=i_needed_modify_power_client_skip_channelgroup_permissions permdesc|permid=65429 permname=i_needed_modify_power_client_force_push_to_talk permdesc|permid=65430 permname=i_needed_modify_power_client_ignore_bans permdesc|permid=65431 permname=i_needed_modify_power_client_ignore_antiflood permdesc|permid=65432 permname=i_needed_modify_power_client_issue_client_query_command permdesc|permid=65433 permname=i_needed_modify_power_client_info_view permdesc|permid=65434 permname=i_needed_modify_power_client_permissionoverview_view permdesc|permid=65435 permname=i_needed_modify_power_client_remoteaddress_view permdesc|permid=65436 permname=i_needed_modify_power_client_serverquery_view_power permdesc|permid=65437 permname=i_needed_modify_power_client_needed_serverquery_view_power permdesc|permid=65438 permname=i_needed_modify_power_client_custom_info_view permdesc|permid=65439 permname=i_needed_modify_power_client_kick_power permdesc|permid=65440 permname=i_needed_modify_power_client_needed_kick_power permdesc|permid=65441 permname=i_needed_modify_power_client_ban_power permdesc|permid=65442 permname=i_needed_modify_power_client_needed_ban_power permdesc|permid=65443 permname=i_needed_modify_power_client_move_power permdesc|permid=65444 permname=i_needed_modify_power_client_needed_move_power permdesc|permid=65445 permname=i_needed_modify_power_client_complain_power permdesc|permid=65446 permname=i_needed_modify_power_client_needed_complain_power permdesc|permid=65447 permname=i_needed_modify_power_client_complain_list permdesc|permid=65448 permname=i_needed_modify_power_client_complain_delete_own permdesc|permid=65449 permname=i_needed_modify_power_client_complain_delete permdesc|permid=65450 permname=i_needed_modify_power_client_ban_list permdesc|permid=65451 permname=i_needed_modify_power_client_ban_create permdesc|permid=65452 permname=i_needed_modify_power_client_ban_delete_own permdesc|permid=65453 permname=i_needed_modify_power_client_ban_delete permdesc|permid=65454 permname=i_needed_modify_power_client_ban_max_bantime permdesc|permid=65455 permname=i_needed_modify_power_client_private_textmessage_power permdesc|permid=65456 permname=i_needed_modify_power_client_needed_private_textmessage_power permdesc|permid=65457 permname=i_needed_modify_power_client_server_textmessage_send permdesc|permid=65458 permname=i_needed_modify_power_client_channel_textmessage_send permdesc|permid=65459 permname=i_needed_modify_power_client_offline_textmessage_send permdesc|permid=65460 permname=i_needed_modify_power_client_talk_power permdesc|permid=65461 permname=i_needed_modify_power_client_needed_talk_power permdesc|permid=65462 permname=i_needed_modify_power_client_poke_power permdesc|permid=65463 permname=i_needed_modify_power_client_needed_poke_power permdesc|permid=65464 permname=i_needed_modify_power_client_set_flag_talker permdesc|permid=65465 permname=i_needed_modify_power_client_modify_description permdesc|permid=65466 permname=i_needed_modify_power_client_modify_dbproperties permdesc|permid=65467 permname=i_needed_modify_power_client_delete_dbproperties permdesc|permid=65468 permname=i_needed_modify_power_client_create_modify_serverquery_login permdesc|permid=65469 permname=i_needed_modify_power_ft_ignore_password permdesc|permid=65470 permname=i_needed_modify_power_ft_transfer_list permdesc|permid=65471 permname=i_needed_modify_power_ft_file_upload_power permdesc|permid=65472 permname=i_needed_modify_power_ft_needed_file_upload_power permdesc|permid=65473 permname=i_needed_modify_power_ft_file_download_power permdesc|permid=65474 permname=i_needed_modify_power_ft_needed_file_download_power permdesc|permid=65475 permname=i_needed_modify_power_ft_file_delete_power permdesc|permid=65476 permname=i_needed_modify_power_ft_needed_file_delete_power permdesc|permid=65477 permname=i_needed_modify_power_ft_file_rename_power permdesc|permid=65478 permname=i_needed_modify_power_ft_needed_file_rename_power permdesc|permid=65479 permname=i_needed_modify_power_ft_file_browse_power permdesc|permid=65480 permname=i_needed_modify_power_ft_needed_file_browse_power permdesc|permid=65481 permname=i_needed_modify_power_ft_directory_create_power permdesc|permid=65482 permname=i_needed_modify_power_ft_needed_directory_create_power permdesc|permid=65483 permname=i_needed_modify_power_ft_quota_mb_download_per_client permdesc|permid=65484 permname=i_needed_modify_power_ft_quota_mb_upload_per_client permdesc";
$getdata=explode('|',$perms);
	foreach($getdata AS $key=>$value)
		{
		$getsettings=explode(' ', $getdata[$key]);
		foreach($getsettings AS $key2=>$value2)
			{
			$equalCount = substr_count($value2, '=');
			if($equalCount > 1)
				{
				$settings = explode('=', $value2);
				for($i=2; $i<=$equalCount; $i++) 
					{
					if(!empty($settings[$i])) 
						{
						$settings[1].= '='.$settings[$i];
						}
					else
						{
						$settings[1].= '=';
						}
					}
				}
			else
				{
				$settings=explode('=', $value2);
				}
			
			if(!empty($settings[0]))
				{
				$allperms[$key][$settings[0]]=$settings[1];
				}
			}
		}
?>