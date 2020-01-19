import mongoose from 'mongoose';

const Schema = mongoose.Schema;

const userSchema = new Schema({
    username: {
        type:String, required: true, unique: true
    },
    password: {
        type:String, required: true,
    },
    address1: {
        type:String, required: true
    },
    address2: {
        type:String
    },
    city: {
        type:String, required: true
    },
    state: {
        type:String, required: true
    },
    zip: {
        type:Number, required: true
    },
    createdAt: {
        type: Date,
        default: Date.now()
      }
});

userSchema.methods.toAuth = function(){
    return {
        username: this.username,
        password: this.password
    };
}
    

let User = mongoose.model('User',userSchema);

userSchema.static('getAuthenticated', function (name, password, callback) {
    
    User.findOne({ username : name }).exec(function (err, user) {
        if (err) {
            return callback(err);
        }

        console.log('Login attempt from:', user);

        // If no such User exists, fail authentication.
        if (!user) {
            return callback(null, null, reasons.NOT_FOUND);
        }

        user.comparePassword(password, function (err, isMatch) {
            if (err) {
                return callback(err);
            }

            return (isMatch)  ? callback(null, user) : callback(null, null, reasons.PASSWORD_INCORRECT);

        });
    });
});

export default User;