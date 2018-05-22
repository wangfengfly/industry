<div class="block" id="block-tables">

                <div class="secondary-navigation">
                    <ul class="wat-cf">
                        <li class="first"><a href="policy">Listing</a></li>
                        <li><a href="policy/create/">New record</a></li>
                    </ul>
                </div>

                <div class="content">
                    <div class="inner">
						<h3>Details of {$table_name}, record #{$id}</h3>

						<table class="table" width="50%">
                        	<thead>
                                <th width="20%">Field</th>
                                <th>Value</th>
                        	</thead>
						    <tr class="{cycle values='odd,even'}">
                            <td>{$policy_fields.id}:</td>
                            <td>{$policy_data.id}</td>
                        </tr><tr class="{cycle values='odd,even'}">
                            <td>{$policy_fields.pub_time}:</td>
                            <td>{$policy_data.pub_time}</td>
                        </tr><tr class="{cycle values='odd,even'}">
                            <td>{$policy_fields.ind_id}:</td>
                            <td>{$policy_data.ind_id}</td>
                        </tr><tr class="{cycle values='odd,even'}">
                            <td>{$policy_fields.pid}:</td>
                            <td>{$policy_data.pid}</td>
                        </tr><tr class="{cycle values='odd,even'}">
                            <td>{$policy_fields.department}:</td>
                            <td>{$policy_data.department}</td>
                        </tr><tr class="{cycle values='odd,even'}">
                            <td>{$policy_fields.title}:</td>
                            <td>{$policy_data.title}</td>
                        </tr><tr class="{cycle values='odd,even'}">
                            <td>{$policy_fields.content}:</td>
                            <td>{$policy_data.content}</td>
                        </tr>
						</table>
                        <div class="actions-bar wat-cf">
                            <div class="actions">
                                <a class="button" href="policy/edit/{$id}">
                                    <img src="iscaffold/backend_skins/images/icons/application_edit.png" alt="Edit record"> Edit record
                                </a>
                            </div>
                        </div>
                    </div><!-- .inner -->
                </div><!-- .content -->
            </div><!-- .block -->
