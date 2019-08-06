
window.addEventListener('load',function(){
    'use strict';
    const ContributorsList=function (idOfListContainer){
        if(!idOfListContainer) throw new Error('#Id of <ul> element containing info of contributors should be set.')
        this.container=$(idOfListContainer);
        this.list=this.getListOfContributors();
        this.init()
        this.addContributor=this.addContributor.bind(this);
        this.removeContributor=this.removeContributor.bind(this);

    };
    ContributorsList.prototype.init=function(){
        
        if(this.container.length>0){
            var _this=this;
            this.container.children().each(function(){
                $(this).find('.fo-close').on('click',function(){
                    var id=$(this).parent().data('id');
                    _this.removeContributor(id);
                })
            })
        }
   
    }
    ContributorsList.prototype.getListOfContributors=function(){
        var arr=[];
        if(this.container&&this.container.children().length>0){
            this.container.children().each(function(){
                    arr.push($(this).data('id'));
                })
        }
            return arr;
       
    }
    ContributorsList.prototype.removeContributor=function(id){
       
            if(this.container&&id){
                this.container.children().each(function(){
                    $(this).data('id')===id&&$(this).remove();
                })
                this.updateList();
            }
            
   
    }
    ContributorsList.prototype.addContributor=function({id,nickName}){
            if(this.container&&id&&this.list.indexOf(parseInt(id))===-1){
                var _this=this;
                var newContributor=this.template(id,nickName);
                this.container.append($(newContributor));
                newContributor.find('.fo-close').on('click',function(){
                    var id=$(this).parent().data('id');
                    _this.removeContributor(id);
                })
                this.updateList();
            }
    }
    ContributorsList.prototype.updateList=function(){
        return this.list=this.getListOfContributors();
      
    }
    ContributorsList.prototype.template=function(id,nickName){
            var liElement=$("<li data-id="+id+"></li>");
            $(liElement).append("<span class='contributor-nickname'>"+nickName+"</span>");
            $(liElement).append("<input type='hidden' name='wp_contributors_plugin_value[]' value="+id+">");
            $(liElement).append("<span class='fo fo-close' >");
            return $(liElement);
    }
    const SelectorGroup=function(selectorId,buttonId,instanceOfContributorsList){
        if(!selectorId) throw new Error('#Id of <select> element containing info of contributors should be set.');
        if(!buttonId) throw new Error('#Id of <button> for adding contributors to the list contributors should be set.');
        const _this=this;
        this.select=$(selectorId);
        this.selectedState={id:-1};
        this.select.change(function(){
            var selectItem=$(this).children("option:selected");
            _this.selectedState={
                id:selectItem.val(),
                nickName:selectItem.text()
            }
        })
        this.addButton=$(buttonId);
        this.CL=instanceOfContributorsList instanceof ContributorsList?instanceOfContributorsList:this.error('instanceOfContributorsList should be instance of ContributorsList');
        this.init();
    }
    SelectorGroup.prototype.error=function(text){
    
            throw new Error(text);
        
    }
    SelectorGroup.prototype.init=function(){
        const _this=this;
        this.addButton.on('click',function(){
            _this.selectedState.id!=-1&&_this.CL.addContributor(_this.selectedState)
                
        })
    }

const CL=new ContributorsList("#editable-contributors-list");
const SG=new SelectorGroup("#selector-contributors","#add-contributor",CL)
});