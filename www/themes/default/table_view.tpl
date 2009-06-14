<div align="center">
	<table border="0" cellspacing="0" cellpadding="0" class="noborder_table">
		<tr>
			<td><a href="{SITE_URL}" title="Домой">Домой</a></td>
			<td>&nbsp;&raquo;&nbsp;</td>
			<td><a href="{SCRIPT_URL}" title="Работа с таблицей {NAME_ORIG_TABLES}">Работа с таблицей {NAME_TABLES}</a></td>
		</tr>
	</table>
    <br />
	<table border="1" cellspacing="0" cellpadding="0">
		<tr>
			<td class="td-title-left">Строк в переводе</td>
			<td class="td-right">{TRANSLATE_ROWS}</td>
		</tr>
		<tr>
			<td class="td-title-left">Полностью переведено</td>
			<td class="td-right">{FULL_TRANSLATE}</td>
		</tr>
		<tr>
			<td class="td-title-left">Всего строк</td>
			<td class="td-right">{ALL_ROWS}</td>
		</tr>
		<tr>
			<td class="td-title-left">% перевода</td>
			<td class="td-right">{PERCENT_TRANSLATE}</td>
		</tr>
		<tr>
			<td class="td-title-left">Последний перерасчет</td>
			<td class="td-right">{LAST_RECALCULATE}</td>
		</tr>
	</table>
	<br />
	<table cellspacing="0" border="0" cellpadding="0" class="noborder_table">
		<tr>
			<td>
<!-- IF_TABLE_NEW_BEGIN -->
				<a href="?action=table_view&subact=new&id={ID_TABLES}" title="Непереведенные"><img src="{THEME_URL}images/b_tblimport.png" alt="Непереведенные" width="16" height="16" title="Непереведенные" /></a>
<!-- IF_TABLE_NEW_END -->
<!-- IF_TABLE_PARTIALLY_BEGIN -->
				<a href="?action=table_view&subact=partially&id={ID_TABLES}" title="Частично переведенные"><img src="{THEME_URL}images/b_unique.png" alt="Частично переведенные" width="16" height="16" title="Частично переведенные" /></a>
<!-- IF_TABLE_PARTIALLY_END -->
<!-- IF_TABLE_TRANSLATED_BEGIN -->
				<a href="?action=table_view&subact=translated&id={ID_TABLES}" title="Переведенные"><img src="{THEME_URL}images/b_ftext.png" alt="Переведенные" width="16" height="16" title="Переведенные" /></a>
<!-- IF_TABLE_TRANSLATED_END -->
<!-- IF_TABLE_EXPORT_BEGIN -->
				<a href="?action=table_export&id={ID_TABLES}" title="Экспорт таблицы"><img src="{THEME_URL}images/b_tblexport.png" alt="Экспорт таблиц" width="16" height="16" title="Экспорт таблиц" /></a>
<!-- IF_TABLE_EXPORT_END -->
			</td>
		</tr>
	</table>
<!-- IF_SELECT_SUBACT_BEGIN -->
	<table cellspacing="0" border="0" cellpadding="0" class="noborder_table">
		<tr>
			<td>
<!-- IF_SELECT_NEW_BEGIN -->
				Сформирован список строк, не попавших в текущий перевод. Показано строк: {SHOW_ROW} из {ALL_ROW}.
<!-- IF_SELECT_NEW_END -->
<!-- IF_SELECT_PARTIALLY_BEGIN -->
				Сформирован список строк, частично переведенных в текущей базе.  Показано строк: {SHOW_ROW} из {ALL_ROW}.
<!-- IF_SELECT_PARTIALLY_END -->
<!-- IF_SELECT_TRANSLATED_BEGIN -->
				Сформирован список строк, полностью переведенных.  Показано строк: {SHOW_ROW} из {ALL_ROW}.
<!-- IF_SELECT_TRANSLATED_END -->
			</td>
		</tr>
	</table>
	<table cellspacing="0" border="0" cellpadding="0" class="noborder_table">
		<tr>
			<td>
<!-- IF_BIG_PREV_BEGIN -->
				<a href="{URL_BIG_PREV}" title="&laquo;"><img src="{THEME_URL}images/bd_firstpage.png" alt="&laquo;" width="16" height="16" title="&laquo;" /></a>
<!-- IF_BIG_PREV_END -->
				&nbsp;
<!-- IF_PREV_BEGIN -->
				<a href="{URL_PREV}" title="&lt;"><img src="{THEME_URL}images/bd_prevpage.png" alt="&lt;" width="16" height="16" title="&lt;" /></a>
<!-- IF_PREV_END -->
<!-- ARRAY_PAGE_BEGIN -->
				&nbsp;<!-- IF_NOT_CUR_PAGE1_BEGIN --><a href="{URL_PAGE}" title="{NUM_PAGE}"><!-- IF_NOT_CUR_PAGE1_END -->{NUM_PAGE}<!-- IF_NOT_CUR_PAGE2_BEGIN --></a><!-- IF_NOT_CUR_PAGE2_END -->
<!-- ARRAY_PAGE_END -->
				&nbsp;
<!-- IF_NEXT_BEGIN -->
				<a href="{URL_NEXT}" title="&gt;"><img src="{THEME_URL}images/bd_nextpage.png" alt="&gt;" width="16" height="16" title="&gt;" /></a>
<!-- IF_NEXT_END -->
				&nbsp;
<!-- IF_BIG_NEXT_BEGIN -->
				<a href="{URL_BIG_NEXT}" title="&raquo;"><img src="{THEME_URL}images/bd_lastpage.png" alt="&raquo;" width="16" height="16" title="&raquo;" /></a>
<!-- IF_BIG_NEXT_END -->
			</td>
		</tr>
	</table>
    <br />
	<table border="1" cellspacing="0" cellpadding="0">
		<tr>
			<td class="td-title-center">&nbsp;Индексное поле &quot;{INDEX_FIELD}&quot;&nbsp;</td>
<!-- IF_WOWHEAD_URL_BEGIN -->
			<td class="td-title-center">&nbsp;Ссылка на Wowhead (Английский)&nbsp;</td>
			<td class="td-title-center">&nbsp;Ссылка на Wowhead (Русский)&nbsp;</td>
<!-- IF_WOWHEAD_URL_END -->
		</tr>
<!-- ARRAY_ROW_BEGIN -->
		<tr>
			<td class="td-right">&nbsp;<a href="?action=table_{SUBACTION}&db_id={DB_ID}&id={ID_ROW}">{ID_ROW}</a>&nbsp;</td>
<!-- IF_WOWHEAD_URL_ROW_BEGIN -->
			<td class="td-center">&nbsp;<a href="{URL_WOWHEAD_ORIG}" title="Ссылка на Wowhead (Английский)" target="_blank">{URL_WOWHEAD_ORIG}</a>&nbsp;</td>
			<td class="td-center">&nbsp;<a href="{URL_WOWHEAD_RUS}" title="Ссылка на Wowhead (Русский)" target="_blank">{URL_WOWHEAD_RUS}</a>&nbsp;</td>
<!-- IF_WOWHEAD_URL_ROW_END -->
		</tr>
<!-- ARRAY_ROW_END -->
	</table>
<!-- IF_SELECT_SUBACT_END -->
</div>