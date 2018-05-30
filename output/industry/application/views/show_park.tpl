<div class="block" id="block-tables">

                <div class="secondary-navigation">
                    <ul class="wat-cf">
                        <li class="first"><a href="park">Listing</a></li>
                        <li><a href="park/create/">New record</a></li>
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
                            <td>{$park_fields.id}:</td>
                            <td>{$park_data.id}</td>
                        </tr><tr class="{cycle values='odd,even'}">
                            <td>{$park_fields.identifier}:</td>
                            <td>{$park_data.identifier}</td>
                        </tr><tr class="{cycle values='odd,even'}">
                            <td>{$park_fields.code}:</td>
                            <td>{$park_data.code}</td>
                        </tr><tr class="{cycle values='odd,even'}">
                            <td>{$park_fields.name}:</td>
                            <td>{$park_data.name}</td>
                        </tr><tr class="{cycle values='odd,even'}">
                            <td>{$park_fields.create_time}:</td>
                            <td>{$park_data.create_time}</td>
                        </tr><tr class="{cycle values='odd,even'}">
                            <td>{$park_fields.area}:</td>
                            <td>{$park_data.area}</td>
                        </tr><tr class="{cycle values='odd,even'}">
                            <td>{$park_fields.prime_ind1}:</td>
                            <td>{$park_data.prime_ind1}</td>
                        </tr><tr class="{cycle values='odd,even'}">
                            <td>{$park_fields.prime_ind2}:</td>
                            <td>{$park_data.prime_ind2}</td>
                        </tr><tr class="{cycle values='odd,even'}">
                            <td>{$park_fields.prime_ind3}:</td>
                            <td>{$park_data.prime_ind3}</td>
                        </tr><tr class="{cycle values='odd,even'}">
                            <td>{$park_fields.prime_ind4}:</td>
                            <td>{$park_data.prime_ind4}</td>
                        </tr><tr class="{cycle values='odd,even'}">
                            <td>{$park_fields.intro}:</td>
                            <td>{$park_data.intro}</td>
                        </tr><tr class="{cycle values='odd,even'}">
                            <td>{$park_fields.url}:</td>
                            <td>{$park_data.url}</td>
                        </tr><tr class="{cycle values='odd,even'}">
                            <td>{$park_fields.phone}:</td>
                            <td>{$park_data.phone}</td>
                        </tr><tr class="{cycle values='odd,even'}">
                            <td>{$park_fields.email}:</td>
                            <td>{$park_data.email}</td>
                        </tr><tr class="{cycle values='odd,even'}">
                            <td>{$park_fields.wechat}:</td>
                            <td>{$park_data.wechat}</td>
                        </tr><tr class="{cycle values='odd,even'}">
                            <td>{$park_fields.companies}:</td>
                            <td>{$park_data.companies}</td>
                        </tr>
                            <tr class="{cycle values='odd,even'}">
                                <td>{$park_fields.level_id}:</td>
                                <td>{$park_data.level_id}</td>
                            </tr>
                            <tr class="{cycle values='odd,even'}">
                                <td>{$park_fields.prov_id}:</td>
                                <td>{$park_data.prov_id}</td>
                            </tr>
						</table>
                        <div class="actions-bar wat-cf">
                            <div class="actions">
                                <a class="button" href="park/edit/{$id}">
                                    <img src="iscaffold/backend_skins/images/icons/application_edit.png" alt="Edit record"> Edit record
                                </a>
                            </div>
                        </div>
                    </div><!-- .inner -->
                </div><!-- .content -->
            </div><!-- .block -->
