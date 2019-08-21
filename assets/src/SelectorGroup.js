import {$} from 'globals';
import ContributorsList from './ContributorsList'

function SelectorGroup(selectorId,buttonId,instanceOfContributorsList){
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

export default SelectorGroup;