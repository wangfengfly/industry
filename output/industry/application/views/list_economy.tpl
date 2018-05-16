<div class="block" id="block-tables">

                <div class="secondary-navigation">
                    <ul class="wat-cf">
                        <li class="first active"><a href="economy">Listing</a></li>
                        <li><a href="economy/create/">New record</a></li>
                    </ul>
                </div>

                <div class="content">
                    <div class="inner">
                        <h3>List of {$table_name}</h3>

                        {if !empty( $economy_data )}
                        <form action="economy/delete" method="post" id="listing_form">
                            <table class="table">
                            	<thead>
                                    <th width="20"> </th>
                                    			<th>{$economy_fields.id}</th>
			<th>{$economy_fields.park_id}</th>
			<th>{$economy_fields.year}</th>
			<th>{$economy_fields.pepole_count}</th>
			<th>{$economy_fields.gross}</th>
			<th>{$economy_fields.delivery}</th>
			<th>{$economy_fields.total_assets}</th>
			<th>{$economy_fields.current_assets}</th>
			<th>{$economy_fields.debt}</th>
			<th>{$economy_fields.owners}</th>
			<th>{$economy_fields.revenue}</th>
			<th>{$economy_fields.profit}</th>
			<th>{$economy_fields.tax}</th>
			<th>{$economy_fields.loss}</th>

                                    <th width="80">Actions</th>
                            	</thead>
                            	<tbody>
                                	{foreach $economy_data as $row}
                                        <tr class="{cycle values='odd,even'}">
                                            <td><input type="checkbox" class="checkbox" name="delete_ids[]" value="{$row.id}" /></td>
                                            				<td>{$row.id}</td>
				<td>{$row.park_id}</td>
				<td>{$row.year}</td>
				<td>{$row.pepole_count}</td>
				<td>{$row.gross}</td>
				<td>{$row.delivery}</td>
				<td>{$row.total_assets}</td>
				<td>{$row.current_assets}</td>
				<td>{$row.debt}</td>
				<td>{$row.owners}</td>
				<td>{$row.revenue}</td>
				<td>{$row.profit}</td>
				<td>{$row.tax}</td>
				<td>{$row.loss}</td>

                                            <td width="80">
                                                <a href="economy/show/{$row.id}"><img src="iscaffold/images/view.png" alt="Show record" /></a>
                                                <a href="economy/edit/{$row.id}"><img src="iscaffold/images/edit.png" alt="Edit record" /></a>
                                                <a href="javascript:chk('economy/delete/{$row.id}')"><img src="iscaffold/images/delete.png" alt="Delete record" /></a>
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
