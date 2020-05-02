<template>
    <form role="form" @submit.prevent="saveInstitute" enctype="multipart/form-data">
        <div class="card-body">
            <!-- INstitute Name and Tag Line -->
            <div class="row">
                <div class="form-group col-md-6" >
                    <label for="instituteName">Institute Name</label>
                    <input type="text" class="form-control" :class="{ 'is-invalid': $v.instituteForm.name.$error }" id="instituteName"
                        placeholder="Enter Name of Institute" v-model.trim="$v.instituteForm.name.$model">
                    <span class="error invalid-feedback" v-if="!$v.instituteForm.name.required">Institute Name is required.</span>
                </div>
                <div class="form-group col-md-6">
                    <label for="instituteTagLine">Tag line</label>
                    <input type="text" class="form-control" :class="{ 'is-invalid': $v.instituteForm.tag_line.$error }" id="instituteTagLine"
                        placeholder="Institute Tag line" v-model.trim="$v.instituteForm.tag_line.$model">
                    <span class="error invalid-feedback" v-if="!$v.instituteForm.tag_line.required">Institute Tag line is required.</span>
                </div>
            </div>
            <!-- Email And Mobile Number -->
            <div class="row">
                <div class="form-group col-md-6" >
                    <label for="instituteEmail">Email</label>
                    <input type="text" class="form-control" :class="{ 'is-invalid': $v.instituteForm.email.$error }" id="instituteEmail"
                        placeholder="Enter Email of Institute" v-model.trim="$v.instituteForm.email.$model">
                    <span class="error invalid-feedback" v-if="!$v.instituteForm.email.required">Institute Email is required.</span>
                    <span class="error invalid-feedback" v-if="!$v.instituteForm.email.email">Invalid Email format.</span>
                </div>
                <div class="form-group col-md-6">
                    <label for="instituteMobileNumber">Mobile Number.</label>
                    <input type="text" class="form-control" :class="{ 'is-invalid': $v.instituteForm.mobile_no.$error }" id="instituteMobileNumber"
                        placeholder="Institute Mobile Number" v-model.trim="$v.instituteForm.mobile_no.$model">
                    <span class="error invalid-feedback" v-if="!$v.instituteForm.mobile_no.required">Institute Mobile number is required.</span>
                    <span class="error invalid-feedback" v-if="!$v.instituteForm.mobile_no.numeric">Institute Mobile number Should be numeric only.</span>
                    <span class="error invalid-feedback" v-if="!$v.instituteForm.mobile_no.minLength || !$v.instituteForm.mobile_no.maxLength">Institute Mobile number must be 10 digit.</span>
                </div>
            </div>
            
            <!-- Website And Registered at -->
            <div class="row">
                <div class="form-group col-md-6" >
                    <label for="instituteWebsite">Website</label>
                    <input type="text" class="form-control" :class="{ 'is-invalid': $v.instituteForm.website.$error }" id="instituteWebsite"
                        placeholder="Enter Website of Institute" v-model.trim="$v.instituteForm.website.$model">
                    <span class="error invalid-feedback" v-if="!$v.instituteForm.website.required">Institute Website is required.</span>
                    <span class="error invalid-feedback" v-if="!$v.instituteForm.website.url">Invalid Website format.</span>
                </div>
                <div class="form-group col-md-6">
                    <label>Registered At.</label>

                    <v-date-picker 
                        :mode='mode' 
                        v-model='$v.instituteForm.registered_at.$model'
                        is-dark
                        :max-date="new Date()"
                        :class="{ 'is-invalid': $v.instituteForm.registered_at.$error }"
                        @input="changeValue"
                    >
                        <input type="text" class= "form-control" :class="{ 'is-invalid': $v.instituteForm.registered_at.$error }" placeholder="Please enter your Registration Date"  v-model='instituteForm.registered_at_formated' />
                    </v-date-picker>

                    <span class="error invalid-feedback" v-if="!$v.instituteForm.registered_at.required">Institute Registration date is required.</span>
                </div>
            </div>

            <!-- LOGO And Address -->
            <div class="row">
                <div class="form-group col-md-12">
                    <label>Address</label>
                    <textarea class="form-control" rows="3" placeholder="Enter Address" v-model="instituteForm.address"></textarea>
                </div>
            </div>
        </div>

        <div class="card-footer">
            <button type="submit" class="btn btn-info" @click.prevent="saveInstitute">
                <i class="fas fa-save"></i> Save
            </button>
            <button type="button" class="btn btn-secondary">
                <i class="fas fa-window-close"></i> Cancel
            </button>
        </div>
    </form>  
</template>

<script>
import { required, minLength, between, email, maxLength, url, numeric } from 'vuelidate/lib/validators';
import moment from 'moment';

export default {
    data() {
        return {
            instituteForm: {
                'name': '',
                'tag_line': '',
                'email': '',
                'mobile_no': '',
                'website':'',
                'logo':'',
                'registered_at':'',
                'registered_at_formated':'',
                'address':''
            },
            mode:'single'
        }
    },
    validations: {
            instituteForm: {
                name: {
                    required
                },
                tag_line: {
                    required
                },
                email: {
                    required,
                    email
                },
                mobile_no: {
                    required,
                    numeric,
                    minLength: minLength(10),
                    maxLength: maxLength(10)
                },
                website: {
                    required,
                    url
                },
                registered_at: {
                    required
                }
            }
    },
    methods: {
        /**
         * Save Institute Details
         */
        saveInstitute(){
            this.$v.$touch();
            if (this.$v.$invalid) {
                // console.log(this.$v);
                this.$toasted.error('Some Error in Form',{
                    'position': 'top-right',
                }).goAway(3000);
            } else {
                // do your submit logic here
                $(".loading").show();
                axios.post('/superadmin/institute/store', this.instituteForm)
                .then(res => {
                    if(res.data.status){
                        $(".loading").hide();
                        swal.fire(
                            'Success',
                            res.data.message,
                            'success'
                        );

                        if(res.data.redirect){
                            window.location.href = res.data.redirect_url;
                        }
                    }else{
                        $(".loading").hide();
                        swal.fire(
                            'Error',
                            res.data.message,
                            'error'
                        );
                    }
                    
                }).catch(err => {
                    $(".loading").hide();
                    console.log(err)
                    swal.fire(
                        'Error',
                        err.message,
                        'error'
                    );
                });
                
            }
        },
        /**
         * Change Calender Date Format
         */
        changeValue(){
            let newFormat = moment(this.instituteForm.registered_at).format('Do MMM, YYYY');
            this.instituteForm.registered_at_formated = newFormat;
        }
    },
}
</script>

<style>

</style>