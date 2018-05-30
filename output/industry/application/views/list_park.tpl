<div class="block" id="block-tables">

                <div class="secondary-navigation">
                    <ul class="wat-cf">
                        <li class="first active"><a href="park">Listing</a></li>
                        <li><a href="park/create/">New record</a></li>
                    </ul>
                </div>

                <div class="content">
                    <div class="inner">
                        <h3>List of {$table_name}</h3>

                        {if !empty( $park_data )}
                        <form action="park/delete" method="post" id="listing_form">
                            <table class="table">
                            	<thead>
                                    <th width="20"> </th>
                                    			<th>{$park_fields.id}</th>
			<th>{$park_fields.identifier}</th>
			<th>{$park_fields.code}</th>
			<th>{$park_fields.name}</th>
			<th>{$park_fields.create_time}</th>
			<th>{$park_fields.area}</th>
			<th>{$park_fields.prime_ind1}</th>
			<th>{$park_fields.prime_ind2}</th>
			<th>{$park_fields.prime_ind3}</th>
			<th>{$park_fields.prime_ind4}</th>
			<th>{$park_fields.intro}</th>
			<th>{$park_fields.url}</th>
			<th>{$park_fields.phone}</th>
			<th>{$park_fields.email}</th>
			<th>{$park_fields.wechat}</th>
			<th>{$park_fields.companies}</th>
            <th>{$park_fields.level_id}</th>
            <th>{$park_fields.prov_id}</th>

                                    <th width="80">Actions</th>
                            	</thead>
                            	<tbody>
                                	{foreach $park_data as $row}
                                        <tr class="{cycle values='odd,even'}">
                                            <td><input type="checkbox" class="checkbox" name="delete_ids[]" value="{$row.id}" /></td>
                                            				<td>{$row.id}</td>
				<td>{$row.identifier}</td>
				<td>{$row.code}</td>
				<td>{$row.name}</td>
				<td>{$row.create_time}</td>
				<td>{$row.area}</td>
				<td>{$row.prime_ind1}</td>
				<td>{$row.prime_ind2}</td>
				<td>{$row.prime_ind3}</td>
				<td>{$row.prime_ind4}</td>
				<td>{$row.intro}</td>
				<td>{$row.url}</td>
				<td>{$row.phone}</td>
				<td>{$row.email}</td>
				<td>{$row.wechat}</td>
				<td>{$row.companies}</td>
                <td>{$row.level_id}</td>
                <td>{$row.prov_id}</td>

                                            <td width="80">
                                                <a href="park/show/{$row.id}"><img src="iscaffold/images/view.png" alt="Show record" /></a>
                                                <a href="park/edit/{$row.id}"><img src="iscaffold/images/edit.png" alt="Edit record" /></a>
                                                <a href="javascript:chk('park/delete/{$row.id}')"><img src="iscaffold/images/delete.png" alt="Delete record" /></a>
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
