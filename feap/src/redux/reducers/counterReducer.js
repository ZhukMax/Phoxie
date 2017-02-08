import * as constants from '../constants';

const initialState = { value: 0 };

export default function(state = initialState, action) {
    switch (action.type) {
        case constants.INCREMENT_COUNTER:
            return { value: state.value + 1 };
        default:
            return state;
    }
}
