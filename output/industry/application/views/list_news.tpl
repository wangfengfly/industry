<div class="block" id="block-tables">

                <div class="secondary-navigation">
                    <ul class="wat-cf">
                        <li class="first active"><a href="news">Listing</a></li>
                        <li><a href="news/create/">New record</a></li>
                    </ul>
                </div>

                <div class="content">
                    <div class="inner">
                        <h3>List of {$table_name}</h3>

                        {if !empty( $news_data )}
                        <form action="news/delete" method="post" id="listing_form">
                            <table class="table">
                            	<thead>
                                    <th width="20"> </th>
                                    			<th>{$news_fields.id}</th>
			<th>{$news_fields.menu_id}</th>
			<th>{$news_fields.pub_time}</th>
			<th>{$news_fields.title}</th>
			<th>{$news_fields.desc}</th>
			<th>{$news_fields.img_url}</th>
			<th>{$news_fields.content}</th>
			<th>{$news_fields.tags}</th>
			<th>{$news_fields.author}</th>

                                    <th width="80">Actions</th>
                            	</thead>
                            	<tbody>
                                	{foreach $news_data as $row}
                                        <tr class="{cycle values='odd,even'}">
                                            <td><input type="checkbox" class="checkbox" name="delete_ids[]" value="{$row.id}" /></td>
                                            				<td>{$row.id}</td>
				<td>{$row.menu_id}</td>
				<td>{$row.pub_time}</td>
				<td>{$row.title}</td>
				<td>{$row.desc}</td>
				<td>{$row.img_url}</td>
				<td>{$row.content}</td>
				<td>{$row.tags}</td>
				<td>{$row.author}</td>

                                            <td width="80">
                                                <a href="news/show/{$row.id}"><img src="iscaffold/images/view.png" alt="Show record" /></a>
                                                <a href="news/edit/{$row.id}"><img src="iscaffold/images/edit.png" alt="Edit record" /></a>
                                                <a href="javascript:chk('news/delete/{$row.id}')"><img src="iscaffold/images/delete.png" alt="Delete record" /></a>
                                            </td>
                            		    </tr>
                                	{/foreach}
                            	</tbody>
                            </table>
                            <div class="actions-bar wat-cf">
                                <div class="actions">
                                    <button class="button" type="submit">
                                        <img src="iscaffold/backend_skins/images/icons/cross.png" alt="Delete"> Delete selected
                                    </button>
                                </div>
                                <div class="pagination">
                                    {$pager}
                                </div>
                            </div>
                        </form>
                        {else}
                            No records found.
                        {/if}

                    </div><!-- .inner -->
                </div><!-- .content -->
            </div><!-- .block -->
