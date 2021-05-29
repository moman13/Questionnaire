<div
        x-data
        x-init="FilePond.setOptions({
            server:{
                process:(fieldName,file,metadata,load,error,progress,abort,transfer,options)=>{
                    @this.upload('file',file,load,error,progress)
                },
                revert:()=>{
                    @this.removeUpload('file',filename,load)
                }
            },

        });
        FilePond.create($refs.input);
    "
        wire:ignore>
    <input type="file" x-ref="input">
</div>