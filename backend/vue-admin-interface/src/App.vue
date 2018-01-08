<template>
    <div>
        <el-main>

            <el-button type="primary" @click="saveSettings()">Save settings</el-button>

            <el-tabs v-model="activeTab">

                <el-tab-pane label="Float Button Settings" name="setting_btn">

                    <el-card class="box-card">
                        <div slot="header" class="clearfix">
                            <span>Main button</span>
                        </div>
                        <div>
                            <el-form label-position="top" label-width="100px" :model="config">
                                <el-row :gutter="5">
                                    <el-col :span="4">
                                        <el-form-item label="Position">
                                            <el-select v-model="config.config_position" placeholder="Select" filterable>
                                                <el-option v-for="item in optionsMainPosition" :key="item.value" :label="item.label" :value="item.value">
                                                </el-option>
                                            </el-select>
                                        </el-form-item>
                                    </el-col>
                                    <el-col :span="4">
                                        <el-form-item label="Position Type">
                                            <el-select v-model="config.config_position_type" placeholder="Select" filterable>
                                                <el-option v-for="item in optionsMainPositionType" :key="item.value" :label="item.label" :value="item.value">
                                                </el-option>
                                            </el-select>
                                        </el-form-item>
                                    </el-col>
                                    <el-col :span="4">
                                        <el-form-item label="Size">
                                            <el-select v-model="config.config_icon_size" placeholder="Select" filterable>
                                                <el-option v-for="item in optionsSize" :key="item.value" :label="item.label" :value="item.value">

                                                </el-option>
                                            </el-select>
                                        </el-form-item>
                                    </el-col>
                                    <el-col :span="4">
                                        <el-form-item label="Color">
                                            <el-color-picker v-model="config.config_bgColor"></el-color-picker>
                                        </el-form-item>
                                    </el-col>
                                </el-row>
                                <el-row :gutter="5">
                                    <el-col :span="4">
                                        <el-form-item label="Icon">


                                            <el-input placeholder="" v-model="config.config_main_icon">
                                                <template slot="prepend">
                                                    <el-tooltip content="Icons on https://material.io/icons" placement="top">
                                                        <i class="el-icon-question"></i>
                                                    </el-tooltip>
                                                </template>
                                            </el-input>
                                        </el-form-item>
                                    </el-col>
                                    <el-col :span="4">
                                        <el-form-item label="Tooltip">
                                            <el-input placeholder="" v-model="config.config_main_tooltip"></el-input>
                                        </el-form-item>
                                    </el-col>
                                </el-row>
                            </el-form>
                        </div>
                    </el-card>

                    <el-card class="box-card">
                        <div slot="header" class="clearfix">
                            <span>Sub element(s)</span>

                        </div>
                        <div>


                            <div v-if="config.config_actions != []">


                                <el-card v-for="(action, index) in config.config_actions" v-bind:key="index" class="box-card">
                                    <div slot="header" class="clearfix">
                                        <span>Sub Item #{{index}}</span>
                                        <el-button @click="config.config_actions.splice(index, 1)" style="float: right; padding: 3px 0" type="text">Delete item</el-button>
                                    </div>
                                    <div>

                                        <el-form label-position="top" label-width="100px" :model="config">
                                            <el-row :gutter="1">
                                                <el-col :span="4">
                                                    <el-form-item label="Icon">

                                            
                                                            <el-input placeholder="" v-model="config.config_actions[index].icon">
                                                                <template slot="prepend">
                                                                    <el-tooltip content="Icons on https://material.io/icons" placement="top">
                                                                        <i class="el-icon-question"></i>
                                                                    </el-tooltip>
                                                                </template>
                                                            </el-input>
                                                        </el-form-item>

                                                </el-col>
                                                <el-col :span="4">
                                                    <el-form-item label="Tooltip">
                                                        <el-input placeholder="" v-model="config.config_actions[index].tooltip"></el-input>
                                                    </el-form-item>
                                                </el-col>
                                                <el-col :span="4">
                                                    <el-form-item label="Color">
                                                        <el-color-picker v-model="config.config_actions[index].color"></el-color-picker>
                                                    </el-form-item>
                                                </el-col>
                                            </el-row>
                                            <el-row :gutter="1">
                                                <el-col :span="4">
                                                    <el-form-item label="Type">
                                                        <el-select v-model="config.config_actions[index].dataBtn.type" placeholder="Select" filterable allow-create>
                                                            <el-option v-for="item in optionsButton" :key="item.value" :label="item.value" :value="item.value">
                                                            </el-option>
                                                        </el-select>
                                                    </el-form-item>
                                                </el-col>
                                                <el-col :span="6">
                                                    <el-form-item label="content">
                                                        <el-input placeholder="http://" v-model="config.config_actions[index].dataBtn.content"></el-input>
                                                    </el-form-item>
                                                </el-col>
                                                <el-col :span="4">
                                                    <el-form-item label="Open Option">
                                                        <el-select v-model="config.config_actions[index].dataBtn.openOption" placeholder="Select" filterable>
                                                            <el-option v-for="item in optionsOpen" :key="item.value" :label="item.value" :value="item.value">
                                                            </el-option>
                                                        </el-select>
                                                    </el-form-item>
                                                </el-col>

                                            </el-row>


                                        </el-form>


                                    </div>
                                </el-card>
                                <el-button @click="addSubItem()" type="success" round>Add Sub Element</el-button>



                            </div>


                        </div>
                    </el-card>

                </el-tab-pane>

                <el-tab-pane label="Setting Pages" name="setting_pages">

                    <el-form label-position="top" label-width="100px">
                        <el-row :gutter="5">
                            <el-col :span="4">
                                <el-form-item label="Mode">
                                    <el-select v-model="configPage.activeSelectPage" placeholder="Select" filterable>
                                        <el-option v-for="item in optionsMultiplePage" :key="item.value" :label="item.label" :value="item.value">
                                        </el-option>
                                    </el-select>
                                </el-form-item>
                            </el-col>
                            <el-col v-if="configPage.activeSelectPage == 'true'" :span="4">
                                <el-form-item label="Select pages" >
                                    <el-select v-model="configPage.selectedPages" placeholder="Select" multiple>
                                        <el-option v-for="item in allPages" :key="item.value" :label="item.label" :value="item.value">
                                        </el-option>
                                    </el-select>
                                </el-form-item>
                            </el-col>

                        </el-row>

                    </el-form>



                </el-tab-pane>
            </el-tabs>



        </el-main>
    </div>
</template>

<script>
export default {
  data: function() {
    return {
      config: {
        config_bgColor: "#409EFF",
        config_position: "bottom-right",
        config_position_type: "fixed",
        config_icon_size: "medium",
        config_main_icon: "add",
        config_main_tooltip: "",
        config_fixed_tooltip: false,
        config_actions: []
      },
      configPage: {
        activeSelectPage: "false",
        selectedPages: []
      },
      importConfig: config_float_btn,
      activeTab: "setting_btn",
      allPages: [],
      optionsMultiplePage: [
        {
          value: "false",
          label: "Active on all page"
        },
        {
          value: "true",
          label: "Select Page(s)"
        }
      ],
      optionsIcon: [],
      optionsMainPosition: [
        {
          value: "bottom-right",
          label: "bottom-right"
        },
        {
          value: "bottom-left",
          label: "bottom-left"
        },
        {
          value: "top-right",
          label: "top-right"
        },
        {
          value: "top-left",
          label: "top-left"
        }
      ],
      optionsMainPositionType: [
        {
          value: "fixed",
          label: "fixed"
        },
        {
          value: "absolute",
          label: "absolute"
        }
      ],
      optionsSize: [
        {
          value: "small",
          label: "small"
        },
        {
          value: "medium",
          label: "medium"
        },
        {
          value: "large",
          label: "large"
        }
      ],
      optionsOpen: [
        {
          value: "_self",
          label: "_self"
        },
        {
          value: "_blank",
          label: "_blank"
        }
      ],
      optionsButton: [
        {
          value: "url",
          label: "url"
        },
        {
          value: "tel",
          label: "tel"
        },
        {
          value: "email",
          label: "email"
        }
      ]
    };
  },
  mounted() {
    var vm = this;
    vm.allPages = allPages;
    console.log(vm.allPages);
    //  vm.config = vm.importConfig;
    console.log("importConfig", vm.importConfig);
    if (vm.importConfig.length > 0) {
      vm.config = vm.importConfig;
      if(!vm.config.config_actions){
         vm.config.config_actions =[]
      }
    }

    if (config_setting_pages.length >  0) {
      vm.configPage = config_setting_pages;
    }

console.log( " vm.config",vm.config)


    /*
  if(!vm.config.config_actions){
      vm.config.push({config_actions:[]})
      
console.log('config_actions definited',vm.config)
  }*/
  },
  methods: {
    saveSettings() {
      var vm = this;

      var data_option_floatbtn = {
        action: "update_option_floatbtn",
        floatConfig: vm.config
      };

      jQuery.post(ajaxurl, data_option_floatbtn, function(response) {});

      var data_update_option_setting_pages = {
        action: "update_option_setting_pages",
        setting_pages: vm.configPage
      };
      jQuery.post(ajaxurl, data_update_option_setting_pages, function(
        response
      ) {});

      this.$notify({
        title: "Saved",
        message: "Settings saved",
        type: "success",
        offset: 40,
        duration: 3000
      });
    },
    addSubItem() {
      var vm = this;

      var modelAction = {
        //   name: "Sub Item #",
        icon: "add",
        tooltip: "",
        color: "#409EFF",
        dataBtn: { type: "url", content: "http://", openOption: "_blank" }
      };

      vm.config.config_actions.push(modelAction);
    }
  }
};
</script>

<style>
#app {
  font-family: Helvetica, sans-serif;
  text-align: center;
}

.input,
input.readonly,
input[readonly],
textarea.readonly,
textarea[readonly] {
  background-color: #ffffff !important;
}
</style>