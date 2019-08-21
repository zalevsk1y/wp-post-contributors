import SelectorGroup from './SelectorGroup';
import ContributorsList from './ContributorsList';
import '../css/plugin-custom-styles.css';

window.addEventListener('load',function(){
    
    const CL=new ContributorsList("#editable-contributors-list");
    const SG=new SelectorGroup("#selector-contributors","#add-contributor",CL)
});