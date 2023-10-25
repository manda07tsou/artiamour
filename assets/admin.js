import "./admin.scss";

import { Dropdown } from "./javascript/components/dropdown.js";
import { FormDeletion} from "./javascript/components/formDeletion.js";

customElements.define('drop-down',Dropdown);
customElements.define('form-deletion', FormDeletion, {extends: 'form'})