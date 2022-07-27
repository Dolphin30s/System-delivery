<template>
    <div class="w-full">
        <label v-if="label">{{ label }}</label>
        <div class="form-file">
            <input
                type="file"
                class="form-file-input"
                @change="handleFileChange"
                :id="fieldId"
            />
            <label class="form-file-label flex w-full" :for="fieldId">
                <span class="form-file-text flex-grow-1">{{ fileTextI18n }}</span>
                <span
                    class="form-file-button"
                >{{ $t('form.field_file_browse') }}</span>
            </label>
        </div>
        <div class="w-full mt-4" v-if="image_url">
            <img class="mx-auto" :src="image_url" height="200" width="200" alt=""/>
        </div>
    </div>
</template>

<script>
export default {
    name: 'CsFileInput',
    data() {
        return {
            fileTextI18n: this.$t('form.field_file_choose'),
            image_url: null
        }
    },
    props: {
        default_url: {type: String, default: null},
        multiple: {type: Boolean, default: false},
        fieldId: {type: String, default: 'file'},
        label: {type: String}
    },
    watch: {
        default_url: function(){
            this.image_url = this.default_url;
        }
    },
    methods: {
        handleFileChange(e) {
            const element = e.target;
            const files = (element && element.files) || new FileList(), count = files.length;

            if (count === 0) {
                this.fileTextI18n = this.$t('form.field_file_choose');
            } else {
                const fileNames = [];
                for (let i = 0; i < count; i++) {
                    fileNames[i] = files[i].name;
                }

                this.fileTextI18n = fileNames.join(' , ');
            }

            let reader = new FileReader();

            reader.onload = (e) => {
                this.image_url = e.target.result;
            };

            reader.readAsDataURL(files[0]);

            this.$emit('onChange', {file: this.multiple ? files : files[0]});
        },
    },
};
</script>

<style>
.form-file {
    position: relative;
    height: calc(2.5em + .875rem + 2px);
}

.form-file-input {
    position: relative;
    z-index: 2;
    width: 100%;
    height: 100%;
    margin: 0;
    opacity: 0;
}

.form-file-label {
    position: absolute;
    top: 0;
    right: 0;
    left: 0;
    z-index: 1;
    display: flex;
    height: 100%;
    border-color: rgba(110, 117, 130, .2);
    border-radius: 3px;
}

.form-file-text {
    display: block;
    flex-grow: 1;
    padding: .9rem .75rem;
    overflow: hidden;
    font-weight: 400;
    line-height: 1.5;
    color: #354052;
    text-overflow: ellipsis;
    white-space: nowrap;
    background-color: #fff;
    border-color: inherit;
    border-style: solid;
    border-width: 1px;
    border-top-left-radius: inherit;
    border-bottom-left-radius: inherit;
}

.form-file-button {
    margin-left: 0;
    border-left: 0;
}

.form-file-button {
    display: block;
    flex-shrink: 0;
    padding: .9rem 1.5rem;
    margin-left: -1px;
    line-height: 1.5;
    color: #354052;
    background-color: rgba(53, 64, 82, .024);
    border-color: inherit;
    border-style: solid;
    border-width: 1px;
    border-top-right-radius: inherit;
    border-bottom-right-radius: inherit;
}
</style>
