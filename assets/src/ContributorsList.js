import {$} from 'globals';

function ContributorsList (idOfListContainer){
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

export default ContributorsList;